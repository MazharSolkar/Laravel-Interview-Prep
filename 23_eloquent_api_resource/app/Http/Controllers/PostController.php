<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categories')->paginate(5);
        return (new PostResourceCollection($posts))->additional([
            'response' => [
                'status' => 200,
                'message' => 'success',
                ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('categories')->findOrFail($id);
        return (new PostResource($post));
    }
}
