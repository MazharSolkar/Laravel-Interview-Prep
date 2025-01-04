<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() {
    Route::resource('/post', PostController::class)->except(['update']);
    Route::post('/post/{post}', [PostController::class, 'update']);
    });

Route::prefix('/user')->group(function() {
    Route::post('/register',[UserController::class, 'register']);
    Route::post('/login',[UserController::class, 'login']);
    Route::delete('/logout',[UserController::class, 'logout'])->middleware('auth:sanctum');
    Route::put('/update-password',[UserController::class, 'updatePassword'])->middleware('auth:sanctum');
});
