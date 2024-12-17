<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('edit-post', function($user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('role', function($user) {
            return $user->role === 'admin';
        });
    }
}
