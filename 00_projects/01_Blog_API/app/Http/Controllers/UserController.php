<?php

namespace App\Http\Controllers;

use App\Events\UserLogin;
use App\Http\Resources\UserResource;
use App\Jobs\UserRegisteredJob;
use App\Models\User;
use App\Trait\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use HttpResponse;

    public function register(Request $request) {
        $fields = $request->validate([
            'name'=>'required|min:4|max:40',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ]);

        $user = User::create($fields);
        $token = $user->createToken($user->email)->plainTextToken;

        dispatch(new UserRegisteredJob($user));

        return $this->success(201,'user registered',['user'=>new UserResource($user), 'token'=>$token]);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $login = Auth::attempt($fields);
        if(!$login) return $this->error(400,'invalid credentials');

        $user = Auth::user();
        $token = $user->createToken($user->email)->plainTextToken;

        event(new UserLogin($user));

        return $this->success(200, 'user logged in', ['user'=>new UserResource($user), 'token'=>$token]);
    }

    public function logout() {
        Auth::user()->currentAccessToken()->delete();
        return $this->success(201, 'user logged out');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        // Check if the current password is correct using Hash::check
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->error(400, 'Current password is incorrect');
        }

        // Update the password
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return $this->success(200, 'Password updated successfully');
    }
}
