<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png}max:3000'
        ]);
        
        // Store image in public disk
        $image_path = $request->photo->store('images', 'public');
        $image_name = basename($image_path);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'photo' => $image_name,
        ]);

        // send mail
        Mail::to($user->email)->send(new UserRegistered($user, $image_name));

        return "email sent";

    }
}
