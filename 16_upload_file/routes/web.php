<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilePicController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('profile-pic',ProfilePicController::class);