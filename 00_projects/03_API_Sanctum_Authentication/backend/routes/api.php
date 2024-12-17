<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetTokenController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Public Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/send-reset-password-email', [PasswordResetTokenController::class, 'sendPasswordResetEmail']);
Route::post('/reset-password/{token}', [PasswordResetTokenController::class, 'resetPassword']);

// Protected Routes
Route::middleware(['auth:sanctum'])->group(function() {
    Route::delete('/logout', [UserController::class, 'logout']);
    Route::get('/user-details', [UserController::class, 'userDetails']);
    Route::put('/change-password', [UserController::class, 'changePassword']);
});