<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index']);
Route::get('/store', [PostController::class, 'store']);
Route::get('/show', [PostController::class, 'show']);
