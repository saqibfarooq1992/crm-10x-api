<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Traits\Jsonify;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use App\Mail\TwoFactorCode;
use App\Mail\Verification;
use App\Mail\WelcomeToNewUser;

class AuthServices
{
    use Jsonify;

    private $model;
    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function register($request)
    {
        $user = User::create($request->all());
        if ($user->save()) {
            $userData = [
                'email'     => $user->email,
                'full_name' => $user->f_name,
            ];

            try {
                Mail::to($user->email)
                ->send(new WelcomeToNewUser($userData));
            } catch (\Exception $e) {
                dd($e->getMessage());
                return response()->json([
                    'message'     => 'Some error occurred, please try again',
                    'status_code' => 500,
                ], 500);
            }

            return response()->json([
                'message'     => 'Your account will be active in 24 hours',
                'status_code' => 200,
            ], 200);
        } else {
            return response()->json([
                'message'     => 'Some error occurred, please try again',
                'status_code' => 500,
            ], 500);
        }
        return $user;
    }
    public function login($request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return self::jsonError('Incorrect email or password.', 401);
        }
        $user = $request->user();
        // Check if the user is verified
        if ($user->is_verified === 'un-verified') {
            $userData = [
                'full_name' => $user->f_name,
            ];
            Mail::to($user->email)
                ->send(new Verification($userData));
            return self::jsonError('Your account is not verified. Please verify your account by clicking the verification link sent to your email.', 401);
        }
        if ($user->is_two_factor === 'enabled') {
            $random = rand(111111, 999999);
            $user->verification_code = $random;
            if($user->save())
            {
                $userData = [
                    'full_name' => $user->f_name,
                    'random'    => $random,
                ];
            }
            Mail::to($user->email)
                ->send(new TwoFactorCode($userData));

                return response()->json([
                    'message'     => 'We have sent you a verification code to your email address',
                    'status_code' => 200,
                    'user' => $user, // Include user information
                    'token' => $user->createToken('auth')->plainTextToken, // Include authentication token
                ], 200);
        }else{
            $user->token = $user->createToken('auth')->plainTextToken;
            return self::jsonSuccess("user successfully login" , $user,  200);
        }
    }
    public function resetPasswordRequest($request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);
        
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'message'     => 'some thing went wrong',
                    'status_code' => 404,
                ], 404);
            } else {

                $random = rand(111111, 999999);
                $user->verification_code = $random;
                
                if ($user->save()) {
                    $userData = [
                        'full_name' => $user->f_name,
                        'random'    => $random,
                    ];

                    Mail::to($user->email)
                        ->send(new ResetPassword($userData));

                    return response()->json([
                        'message'     => 'We have sent you a verification code to your email address',
                        'status_code' => 200,
                    ], 200);
                } else {
                    return response()->json([
                        'message'     => 'Some error occurred, please try again',
                        'status_code' => 500,
                    ], 500);
                }
            }
        } catch (Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function resetPassword($request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'verification_code' => 'required',
                'password' => 'required|confirmed|min:6',
    
            ]);
            $user = User::where('email' , $request->email)->where('verification_code' , $request->verification_code)->first();
            if(!$user){
                return response()->json([
                    'message'   => 'User not found / Invalid code',
                    'status_code' => 401,
                ], 401);
            }else{
                $user->password =bcrypt(trim($request->password));
                $user->verification_code = null;
                if($user->save()){
                     return response()->json([
                            'message' => 'Password Updated Successfully',
                            'status_code' => 200,
                        ], 200);
                }else{
                    return response()->json([
                        'message' => 'Some error occured , please try again',
                        'status_code' => 500,
                    ], 500);
                }
            }
        } catch (Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function twoFactorAuthentication($request)
    {
        $request->validate([
            'verification_code' => 'required|string',
        ]);
        $user = Auth::user();
        // Check if the provided token matches the token stored in the database
        if ($request->verification_code !== $user->verification_code) {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    
        // Clear the two-factor authentication token from the user record
        $user->verification_code = null;
        $user->save();
    
        // Generate a new authentication token
        $token = $user->createToken('auth')->plainTextToken;
    
        return response()->json(['message' => 'Two-factor authentication successful', 'token' => $token , 'data' => $user]);
    }

    public function towFAStatusChange()
    {
        try {
            $user = Auth::user();
            $user->is_two_factor = $user->is_two_factor === 'enabled'? 'disabled' : 'enabled';
            $user->save();
        return response()->json(['message' => "Two Factor Authentication is ". $user->is_two_factor], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function accountVerification()
    {
        try {
            $user = Auth::user();
            $user->is_verified = $user->is_verified === 'un-verified'? 'verified' : 'un-verified';
            $user->save();
        return response()->json(['message' => "Account successfully ". $user->is_verified], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
