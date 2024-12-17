<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function addUser (Request $request) {
        $request->validate(
            [
                "username"=> "required | min:3 | max:10",
                "email"=> "required | email",
                "city"=> "required | uppercase",
                "skill"=> "required | max:10"
            ], [
                "username.required" => "username can't be empty",
                "username.min" => "username mininum 3 characters",
                "username.max" => "username maximum 10 characters",
                "email.required" => "email can't be empty",
            ],
            );
    }
}
