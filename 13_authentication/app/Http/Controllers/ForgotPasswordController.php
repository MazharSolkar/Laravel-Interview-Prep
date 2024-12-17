<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordEmail;

class ForgotPasswordController extends Controller
{
    public function sendForgotPasswordEmail(Request $request) {
        // Validate
        $fields = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate Token
        $token = str()->random(60);

        // Delete any existing tokens for this email
        PasswordResetToken::where('email', $request->email)->delete();

        // Insert new token
        PasswordResetToken::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

         // Sending email
        $user = User::where('email', $request->email)->first();

        $mailData = [
            'token' => $token,
            'user' => $user,
            'subject' => 'You have requested to change your password.'
        ];

        Mail::to($request->email)->send(new ForgotPasswordEmail($mailData));

        return redirect()->route('user.forgot.password.form')->with('success', 'Reset password email has been sent to your inbox.');

    }

    public function passwordResetForm($token) {
        // Check if token exists in db
        $resetToken = PasswordResetToken::where('token', $token)->first();

        // if doesn't exist then redirect
        if ($resetToken == null) {
            return redirect()->route('user.forgot.password.form')->withErrors('error', 'Invalid token.');
        }

        return view('user.reset-password', ['token' => $resetToken->token]);
    }

    public function resetPassword(Request $request, $token) {
        // Validate request data
        $validatedData = $request->validate([
            'password' => 'required|min:5|confirmed',
        ]);

        // Check if token exists in db
        $resetToken = PasswordResetToken::where('token', $token)->first();

        // If doesn't exist then redirect
        if ($resetToken == null) {
            return redirect()->route('user.forgot.password.form')->withErrors('error', 'Invalid token.');
        }

        // Update password of the user
        $user = User::where('email', $resetToken->email)->first();
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        // delete token
        PasswordResetToken::where('email', $resetToken->email)->delete();

        return redirect()->route('user.login')->with('success', 'You have successfully changed your password.');
    }


}
