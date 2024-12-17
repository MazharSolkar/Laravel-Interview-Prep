<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    // fetch non trashed records
    $users = User::all();

    // fetch trashed/soft deleted record
    $users = User::withTrashed()->get();

    // fetch only trashed record
    $users = User::onlyTrashed()->get();
    
    // restores
    $users = User::withTrashed()->find(3)->restore();
    // $users = User::all();

    dd($users);
});
