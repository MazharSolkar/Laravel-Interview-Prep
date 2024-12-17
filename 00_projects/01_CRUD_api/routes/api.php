<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/v1/post', [PostController::class, 'index']);
Route::post('/v1/post', [PostController::class, 'store']);
Route::get('/v1/post/{post}', [PostController::class, 'show']);
Route::put('/v1/post/{post}', [PostController::class, 'update']);
Route::delete('/v1/post/{post}', [PostController::class, 'destroy']);
