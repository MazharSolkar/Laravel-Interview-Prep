<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use HttpResponse;

    public function register(RegisterRequest $request) {

        $fields = $request->validated();

        $fields['password'] = bcrypt($request->password);

        $user = User::create($fields);

        /**
         * todo: Generate token using sanctum after registration:
         *
         * this token will be sent to frontend to Authenticate user.
         * in frontend this token can be stored in localstorage or cookies,
         * and attached to http request to authenticate and verify user.
         *
         */
        // generate sanctum token
        $token = $user->createToken($request->email)->plainTextToken;

        return $this->success(201, [
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(LoginRequest $request)
    {
    $validatedData = $request->validated();

    // 2. Attempt to authenticate the user
    if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return $this->error(400, '', 'Invalid Credentials');
    }

    // 3. Retrieve the authenticated user
    $user = Auth::user();

    // 4. Generate Sanctum token for user
    $token = $user->createToken($request->email)->plainTextToken;

    // 5. Return success response with token
    return $this->success(200, ['token'=>$token]);
}

    public function logout() {
        // You may "revoke" tokens by deleting them from your database using the tokens relationship that is provided by the Laravel\Sanctum\HasApiTokens trait
        Auth::user()->tokens()->delete();
        return $this->success(200, '', 'You have successfully been logged out and your tokens has been deleted.');
    }

    public function userDetails() {
        $user = Auth::user();
        $this->success(200, ['user'=>$user], 'Currently logged in users details');
    }

    public function changePassword(ChangePasswordRequest $request) {
        $fields = $request->validated();
        // 2. check old password is correct.
        $checkPassword = Hash::check($request->password, Auth::user()->password);
        // 3. if old password is incorrect return error response
        if(!$checkPassword) {
            return $this->error(400,'','Incorrect Password');
        }

        // 4. update password
        $user = Auth::user();
        $user->password = bcrypt($fields['new_password']);
        $user->update();

        return $this->success(200,'','Password Changed Successfully.');
    }
}
