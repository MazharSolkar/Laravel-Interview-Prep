<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;

Route::get('/', function () {
    $posts = Post::active(0)
        ->get();

    dd($posts->toArray());

    // $categories = Category::with(['posts' => function($q) {
    //     $q->active(true)->postDetail();
    // }])->get();

    // dd($categories->toArray());
});
