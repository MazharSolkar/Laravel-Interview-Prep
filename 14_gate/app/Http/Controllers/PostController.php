<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('home', compact('posts'));
    }

    public function edit(Post $post) {
        if(Gate::denies('edit-post', $post)) {
            return "<h1>You are not allowed to edit this</h1>";
        }
        return view('editPost', compact('post'));
    }

    public function admin() {
        if(!Gate::allows('role')){
            return "<h1>You are not allowed to access admin panel</h1>";
        }
        return "<h1>Admin Panel</h1>";
    }

}
