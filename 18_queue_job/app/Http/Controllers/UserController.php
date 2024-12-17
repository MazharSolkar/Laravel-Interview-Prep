<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserRegistered;
use App\Jobs\UserRegisteredJob;

class UserController extends Controller
{
    public function register(Request $request) {
        $fields= $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create($fields);

        dispatch(new UserRegisteredJob($user));

        // Mail::to($user->email)->send(new UserRegistered($user));

        return "email sent";
    }
}
