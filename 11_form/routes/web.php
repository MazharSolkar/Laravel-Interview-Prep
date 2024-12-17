<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::view('/user-form','form');

Route::Post('/adduser', [UserController::class,'addUser']);

