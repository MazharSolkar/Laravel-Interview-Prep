<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::view('/','register');
Route::post('/', [UserController::class, 'register'])->name('user.register');
