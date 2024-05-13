<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Jsonify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    use Jsonify;

    public function update(Request $request)
    {
        $user = auth()->user();
        // Validate request data
        $request->validate([
            'f_name' => 'required|string|max:255',
        ]);
        // Update user profile
        $user->f_name = $request->input('f_name');
        if ($request->has('email')) {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            ]);
            $user->email = $request->input('email');
        }
        // Update other fields as needed
        $user->save();
        return response()->json([
           'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();;

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'The provided current password does not match our records'], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }
    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
           
            $user = auth()->user();
            // Check if the user has an existing avatar
            $oldAvatarPath = public_path('avatar') . '/' . $user->avatar;
            if (File::exists($oldAvatarPath)) {
                // If old avatar exists, remove it
                File::delete($oldAvatarPath);
            }
            if ($request->hasFile('avatar')) {
                $avatarName = $user->id.'_'.time().'.'.$request->avatar->extension();
                $request->avatar->move(public_path('avatar'), $avatarName);
                $user->avatar = $avatarName;
                $user->save();
                return response()->json([
                    'message' => 'Avatar updated successfully',
                    'avatar' => $user->avatar,
                    'code' => 200
                 ]);
            }else {
                return response()->json([
                    'message' => 'Something went wrong',
                    'code' => 500
                 ]);
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
