<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Post;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('post.edit', function ($user, Post $post): bool {
            return $user->role === 'admin' || $user->id === $post->user_id;
        });

        Gate::define('post.delete', function ($user, Post $post): bool {
            return $user->role === 'admin' || $user->id === $post->user_id;
        });
        Gate::define('post.back.admin', function ($user): bool {
            return $user->role === 'admin';
        });
        Gate::define('post.back.user', function ($user): bool {
            return $user->role === 'user';
        });
    }
}