<?php

namespace App\Listeners;

use App\Events\UserLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserLoggedInEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLogin $event): void
    {
        // Log::info('listener called');
        Mail::raw('User Registered sucessfully.',
        function($message) use($event) {
            $message->to($event->user->email);
            $message->subject('Thank You');
        });
    }
}
