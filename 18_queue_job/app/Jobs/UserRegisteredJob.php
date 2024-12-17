<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserRegistered;

class UserRegisteredJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new UserRegistered($this->user));
    }
}
