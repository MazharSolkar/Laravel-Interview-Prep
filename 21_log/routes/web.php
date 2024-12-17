<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\User;

Route::get('/', function () {
    Log::info('Fetching users from users table');
    $users = User::all();
    Log::info('Successfully fetched all users from users table: ',['users' => $users->toArray()]);

    dd($users->toArray());
});
