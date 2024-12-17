<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;

class PasswordResetTokenController extends Controller
{
    public function sendPasswordResetEmail(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        // 1. Check User's email exists in db or not
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return response([
                'message' => 'Email does not exist',
                'status' => 'failed'
            ], 404);
        }

        // 2. Delete any existing tokens for this email
        PasswordResetToken::where('email', $user->email)->delete();

        // 3. generate token
        $token = str()->random(60);

        // 4. Saving Data to Password Reset Table
        PasswordResetToken::create([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // dump("http://127.0.0.1:3000/api/user/reset/".$token);
        $resetUrl = "http://localhost:5173/api/user/reset-password/".$token;

        // 5. Sending email with `emails/reset-password` view
        Mail::send('emails.reset-password', compact('resetUrl'), function(Message $message) use($user) {
            $message->subject('Reset Your Password');
            $message->to($user->email);
        });

        return response([
            'message' => 'Password Reset Email Sent... Check Your Email',
            'status' => 'success'
        ], 200);
    }

    public function resetPassword(Request $request, $token) {

        // Delete Token older than 1 minute
        $time = now()->subMinutes(4)->toDateTimeString();
        PasswordResetToken::where('created_at', '<=', $time)->delete();

        // Validate incoming data
        $validatedData = $request->validate([
            'password' => 'required|min:4|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        // get instance of PasswordResetToken Model where token == incoming token from url
        $passwordResetToken = PasswordResetToken::where('token', $token)->first();

        // token not found in PasswordResetToken Model return error response
        if(!$passwordResetToken) {
            return response([
                'message' => 'Token is Invalid or Expired',
                'status' => 'failed'
            ],404);
        }

        // update password of user where email == passwordResetToken->email
        $user = User::where('email', $passwordResetToken->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Delete the token after resetting password
        PasswordResetToken::where('email', $user->email)->delete();

        return response([
            'message' => 'password reset successfully.',
            'status' => 'success'
        ], 200);

    }
}
