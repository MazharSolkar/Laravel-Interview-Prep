<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\UserSubscribedEvent;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request) {

        $fields = $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required',
            'subsribe' => 'nullable|booleans',
        ]);

        // Register user
        $user = User::create($fields);

        // send email
        if($request->subscribe) {
            event(new UserSubscribedEvent($user));
        }

        // redirect
        return "User Registered Successfully.";

    }
}
