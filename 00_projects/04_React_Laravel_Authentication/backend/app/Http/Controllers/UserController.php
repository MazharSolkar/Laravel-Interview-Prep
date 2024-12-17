<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request) {

        // 1. validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:4|same:confirm_password',
            'confirm_password' => 'required',
            'terms_and_condition' => 'required',
        ]);

        // 2. Check if email alread exists
        if(User::where('email', $request->email)->first()) {
            return response([
                'message' => 'Email already exists',
                'status' => 'failed'
            ], 200);
        }

        // 3. hash password
        $validatedData['password'] = bcrypt($request->password);
        // $validatedData['terms_and_condition'] = json_decode($request->terms_and_condition);

        // 4. register user
        $user = User::create($validatedData);

        /**
         * todo: Generate token using sanctum after registration: 
         *
         * this token will be sent to frontend to Authenticate user.
         * in frontend this token can be stored in localstorage or cookies,
         * and attached to http request to authenticate and verify user.
         * 
         */
        // 5. generate token
        $token = $user->createToken($request->email)->plainTextToken;

        // 6. return response.
        return response([
            'token' => $token,
            'message' => 'User Registered Successfully.',
            'status' => 'success'
        ], 201);
    }
    public function login(Request $request) {

        // 1. validate incoming data.
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. check if user exists in db by provided email
        $user = User::where('email', $request->email)->first();
        
        // 3. If user doesn't exist or the password is incorrect, return an error response
        if(!$user || !(Hash::check($request->password, $user->password))) {
            return response([
                'message' => 'invalid credentials.',
                'status' => 'failed'
            ], 401);
        }

        // 5. if password is correct run login logic

        // 6. generate token for authenticating user.
        $token = $user->createToken($request->email)->plainTextToken;

        // 7. resturn success response
        return response([
            'token' => $token,
            'message' => 'User Logged in Successfully.',
            'status' => 'success'
        ], 200);

    }

    public function logout() {
        // You may "revoke" tokens by deleting them from user_access_tokens table, using the tokens relationship that is provided by the Laravel\Sanctum\HasApiTokens trait
        Auth::user()->tokens()->delete();
        return response([
            'message' => 'User Logged out Successfully.',
            'status' => 'success'
        ], 200);
    }

    public function userDetails() {

        $user = Auth::user();
        return response([
            'user' => $user,
            'message' => 'Currently logged in users details.',
            'status' => 'success'
        ], 200);
    }

    public function changePassword(Request $request) {
        // 1. validate incoming data: password, new_password, confirm_new_password
        $validatedData = $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:4|same:confirm_new_password',
            'confirm_new_password' => 'required'
        ]);
        // 2. check old password is correct.
        $checkPassword = Hash::check($request->password, Auth::user()->password);
        // 3. if old password is incorrect return error response
        if(!$checkPassword) {
            return response()->json([
                'message' => 'Incorrect Password.',
                'status' => 'failed'
            ], 401);
        }

        // 4. update the user's password with new_password after hashing the new_password and return success response.
        $validatedData['new_password'] = bcrypt($request->new_password);

        $user = Auth::user();
        $user->password = $validatedData['new_password'];
        $user->update();

        return response()->json([
            'message' => 'Password Changed Successfully.',
            'status' => 'success'
        ], 200);

    }
}
