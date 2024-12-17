<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('posts')->get();
        return UserResource::collection($users->loadCount('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
