<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {
        // dd($request->all);
        // Validation
        $fields = $request->validate([
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email|max:30',
            'photo' => 'nullable|mimes:jpg,png,jpeg|max:3000',
            'password' => 'required|confirmed|min:4|max:30',
        ]);

        // Store photo in public disk
        $image_path = $request->photo ? $request->photo->store('images', 'public') : null;
        $image_name = basename($image_path);

        // Create User
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']), // Encrypt password
            'photo' => $image_name,
        ]);

        // Login
        Auth::login($user);

        // Redirect with success message
        return redirect('/')->with(['success' => 'User Registered Successfully.']);
    }


    public function login(Request $request) {
        // dd($request->all());

        // Validate
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Login
        $loginStatus = Auth::attempt($fields);

        // check login success
        if($loginStatus == false) {
            // If login fails, redirect back with an error message and input data
            return redirect()->back()->withErrors(['error' => 'Invalid Credentials. Please try again.'])->withInput();
        }
        // Redirect
        return redirect()->route('home')->with(['success' => "welcome back ".Auth::user()->name]);
    }

    public function logout() {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return back()->with('success', 'User is already logged out.');
        }

        // Log out the user
        Auth::logout();

        // Redirect to the login page with a success message
        return back()->withErrors(['error' => 'User logged out successfully.']);
    }

    public function profile(Request $request, User $user) {
        if (Gate::denies('is-owner', $user)) {
            abort(403);
        }
        return view('user.profile', compact('user'));
    }


    public function updateProfile(Request $request, User $user) {

        // validate
        $fields = $request->validate([
            'name' => 'max:30',
            'email' => 'email|unique:users,email,'.Auth::user()->id,
            'photo' => 'image|mimes:jpg,jpeg,png|max:3000'
        ]);

        if($request->photo) {
            $image_path = Public_path("storage/images/$user->photo");
            if(file_exists($image_path)) {
                @unlink($image_path);

                $image_path = $request->photo->store('images','public');
                $image_name = basename($image_path);
                $fields['photo'] = $image_name;
            }
        }

        // update
        $user->update($fields);

        // redirect
        return redirect()->back()->with(['success' => 'Profile Updated.']);
    }
}
