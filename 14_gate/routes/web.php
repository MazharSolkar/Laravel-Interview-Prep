<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'loginForm']);
Route::post('/process-login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/home', [PostController::class, 'index']);
Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.editForm');

Route::get('/admin', [PostController::class, 'admin'])->can('role');