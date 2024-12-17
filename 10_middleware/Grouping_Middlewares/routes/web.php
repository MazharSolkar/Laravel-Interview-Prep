<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "<h1>Home Page</h1>";
});

Route::get('dashboard', function() {
    return "<h1>Dashboard Page</h1>";
})->middleware('validator');

