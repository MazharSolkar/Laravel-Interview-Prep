<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'nullable|boolean',
        ]);

        // dd($fields);

        $user = User::create($fields);

        return "user registered";
    }
}
