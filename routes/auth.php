<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
/**
 * Users Register Route
 */
Route::prefix('/register')->middleware('guest')->name('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'register'])->name('register');
    Route::post('/processRegister', [AuthController::class, 'processRegister'])->name('processRegister')->middleware('throttle:login');
});

/**
 * Users verify email Route
 */    
Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification',  [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/**
 * Users login Route
 */
Route::prefix('/login')->middleware('guest')->name('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/processLogin', [AuthController::class, 'processLogin'])->middleware(['throttle:login'])->name('processLogin');
});


/**
 * Reset Password Email Route
 */
Route::prefix('/forgot-password')->middleware('guest')->name('forgotPassword.')->group(function () {
    Route::get('', [ForgotController::class, 'forgotPassword'])->name('forgotPasswordForm');
    Route::post('', [ForgotController::class, 'processForgotPassword'])->name('processForgotPassword');
    
});


/**
 * Reset Password Route
 */
Route::prefix('/reset-password')->middleware('guest')->name('reset-password.')->group(function () {
    // Route::get('/reset/{token}', [ForgotController::class, 'resetPassword'])->name('resetPassword');
    // Route::post('/reset/{token}', [ForgotController::class, 'processResetPassword'])->name('processResetPassword');

    Route::get('{userId}/{token}', [ForgotController::class, 'resetPassword'])->name('resetPassword');
    Route::post('{userId}/{token}', [ForgotController::class, 'processResetPassword'])->name('process-password');
});


/**
 * Change Password Route
 */
Route::prefix('/change-password')->group(function () {

});


Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');