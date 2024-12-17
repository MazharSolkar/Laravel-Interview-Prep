<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/home',function() {
    return view('home');
})->name('home');

Route::view('/','registerForm')->name('user.register.form');
Route::view('/login','loginForm')->name('user.login.form');

Route::post('/process-register', [UserController::class, 'register'])->name('user.register');
Route::post('/process-login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');