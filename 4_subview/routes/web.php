<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $fruits = ['apple', 'banana', 'mango', 'orange'];
    $vegetables = ['carrot', 'onion', 'potato', 'Beetroot', 'spinich'];
      
    return view('welcome', compact('fruits', 'vegetables'));
});

