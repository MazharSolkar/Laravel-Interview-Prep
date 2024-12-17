<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginForm() {
        return (Auth::check()) ? redirect('/home') : view('loginForm');
    }
    public function login(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($validatedData)) {
            return redirect('/');
        } else {
            return "<h1>Invalid Credentials</h1>";
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
