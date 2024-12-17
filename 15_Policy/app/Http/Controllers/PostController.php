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
        Gate::authorize('update', $post);
        return view('editPost', compact('post'));
    }

    public function admin() {
        Gate::authorize('admin');

        return "<h1>Admin Panel</h1>";
    }

    public function create()
    {
        $this->authorize('create', Blog::class);
        // further your logic
    } 
}
