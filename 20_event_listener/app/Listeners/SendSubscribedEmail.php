<?php

namespace App\Listeners;

use App\Events\UserSubscribedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSubscribedEmail implements ShouldQueue
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
    public function handle(UserSubscribedEvent $event): void
    {
        // dd('listener called '.$event->name);
        Mail::raw('<h1>Thank you for subscribing to our newsletter</h1>',
        function($message) use($event) {
            $message->to($event->user->email);
            $message->subject('Thank You');
        });
    }
}
