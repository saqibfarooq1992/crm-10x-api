<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\{
    AuthController,
};
use App\Http\Controllers\Api\{
    ProfileController,
    ContactController,
    LeadController,
    UserController,
    RoleController,
    SocialController,
    PropertyController
};

// authentication route
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/reset-password', 'resetPassword');
    Route::post('/forgot-password', 'resetPasswordRequest');
    Route::post('/two-factor-authentication', 'twoFactorAuthentication')->middleware('auth:api');
    Route::post('/change-two-factor-status', 'towFAStatusChange')->middleware('auth:api');
    Route::post('/account-verification', 'accountVerification')->middleware('auth:api');
});


Route::middleware(['auth:api'])->group(function () { 

    // resource route
    Route::apiResources([
        'users' => UserController::class,
        'roles' => RoleController::class,
        'contacts' => ContactController::class,
        'socials' => SocialController::class,
        'leads' => LeadController::class,
        'properties' => PropertyController::class
    ]);

    // profile route
    Route::controller(ProfileController::class)->group(function () {
        Route::post('/profile', 'update');
        Route::post('/update-avatar', 'updateAvatar');
        Route::post('/update-password', 'updatePassword');
    });

    // read contact
    Route::controller(ContactController::class)->group(function () {
        Route::post('/social-media', 'social');
        Route::post('/file', 'upload');
        Route::post('/add-task', 'task');
        Route::post('/add-assignment', 'assignment');
        Route::post('/add-notes', 'notes');
        Route::get('/add-call', 'call');
        Route::post('/add-email', 'email');
        Route::post('/send-sms', 'sms');
        Route::post('/import', 'import');
        Route::get('/export', 'export');

    });
});