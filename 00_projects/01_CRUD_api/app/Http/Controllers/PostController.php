<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Models\Post;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return new PostResourceCollection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Create Post
        $post = Post::create($request->validated());

        // Return response
        return $this->success(201,'New Post Created',['post'=>$post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if(!$post) return $this->error(404,'Post Not Found');

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request->toArray());

        $post->update($request->validated());

        return $this->success(200,'Post Updated', ['post'=>$post]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if(!$post) return $this->error(404,'Post Not Found');

        $post->delete();
        return $this->success(200,'Post Deleted');
    }
}
