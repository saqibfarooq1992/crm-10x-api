<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthServices;
use App\Traits\Jsonify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use Jsonify;
    private $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        try {
            return self::jsonSuccess(message: 'User saved successfully!', data: $this->authService->register($request));
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function login(LoginRequest $request)
    {
        try {
            $data = $this->authService->login($request);
            return $data;
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();
            return self::jsonSuccess(message: 'User logged out successfully.', code: 200);
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function resetPasswordRequest(Request $request)
    {
        try {
            return self::jsonSuccess(data: $this->authService->resetPasswordRequest($request), code: 200);
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function resetPassword(Request $request)
    {
        try {
            return self::jsonSuccess(data: $this->authService->resetPassword($request), code: 200);
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function twoFactorAuthentication(Request $request)
    {
        try {
            return self::jsonSuccess(data: $this->authService->twoFactorAuthentication($request), code: 200);
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function towFAStatusChange()
    {
        try {
            return self::jsonSuccess(data: $this->authService->towFAStatusChange(), code: 200);
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
    public function accountVerification()
    {
        try {
            return self::jsonSuccess(data: $this->authService->accountVerification(), code: 200);
        } catch (\Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
}
