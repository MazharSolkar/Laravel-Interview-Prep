<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UnderConstruction;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\AgeChecker;

Route::get('/', function () {
    return "<h1>Home page</h1>";
});

Route::get('vote', function () {
    return "<h1>Vote Page</h1>";
})->middleware(AgeChecker::class);

