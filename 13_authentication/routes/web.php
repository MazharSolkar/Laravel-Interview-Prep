<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;


Route::view('/', 'home')->name('home');

Route::middleware('guest')->group(function () {
    Route::view('/register', 'user.register-form')->name('user.register.form');
    Route::post('/register', [UserController::class, 'register'])->name('user.register');

    Route::view('/login', 'user.login-form')->name('user.login.form');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');

    Route::view('/forgot-password', 'user.forgot-password')->name('user.forgot.password.form');
    Route::post('/send-forgot-password-email', [ForgotPasswordController::class, 'sendForgotPasswordEmail'])->name('user.forgot.password.email');
    Route::get('/password-reset-form/{token}', [ForgotPasswordController::class, 'passwordResetForm'])->name('user.reset.password.form');
    Route::post('/process-password-reset/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('user.reset.password');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/profile/{user}', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/update-profile/{user}', [UserController::class, 'updateProfile'])->name('user.profile.update');
});
