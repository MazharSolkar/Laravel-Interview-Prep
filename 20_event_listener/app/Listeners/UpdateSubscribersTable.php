<?php

namespace App\Listeners;

use App\Events\UserSubscribedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UpdateSubscribersTable implements ShouldQueue
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
        DB::insert('insert into subscribers (email) value (?)', [$event->user->email]);
    }
}
