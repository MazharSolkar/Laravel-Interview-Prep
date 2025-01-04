<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Trait\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user','categories')->latest()->get();
        // return $this->success(200,'fetched',$posts);
        return new PostCollection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|min:4|max:30',
            'content'=>'required|min:4|max:500',
            'image'=>'nullable|file|mimes:jpg,jpeg,png|max:3000',
            'categories'=>'nullable|array',
            'categories.*' => 'exists:categories,id',
            'user_id'=>'nullable',
        ]);

        $image_path = $request->hasFile('image')? Storage::disk('public')->put('images',$request->image) : null;
        Log::info($image_path);

        $post = Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'image'=>$image_path,
            'user_id'=> Auth::user()->id,
        ]);

        $post->categories()->attach($request->categories);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if(!$post) return $this->error(404,'Post not found');


        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if(Gate::denies('is-owner', $post)) {
            return $this->error(401,'You are not authorized to access this page');
        }

        if(!$post) return $this->error(404,'Post not found');

        $request->validate([
            'title'=> 'nullable|min:4|max:30',
            'content'=>'nullable|min:4|max:500',
            'image'=>'nullable|mimes:jpeg,jpg,png|max:3000',
            'categories'=>'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $image_path = $post->image;
        if($request->hasFile('image')) {
            Storage::disk('public')->delete($image_path);
            $image_path = Storage::disk('public')->put('images', $request->image);
        }

        $post->update([
            'title'=>$request->title ?? $post->title,
            'content'=>$request->content ?? $post->content,
            'image'=>$image_path,
            'user->id'=>$post->user_id,
        ]);

        $post->categories()->sync($request->categories);

        return $this->success(200,'post updated',new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if(!$post) {
            return $this->error(404,'Post not found');
        }

        $post->delete();
    }
}
