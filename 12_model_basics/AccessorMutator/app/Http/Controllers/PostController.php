<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        dd($posts->toArray());
    }

    public function store() {
        $post = new Post();
        $post->post_title = "new post 2";
        $post->post_body = "lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, culpa.";
        $post->save();
        // dont use redirect here as it will create loop and instead of one, more records will be created on each reqeust.
        return "Record is inserted";
    }

}
