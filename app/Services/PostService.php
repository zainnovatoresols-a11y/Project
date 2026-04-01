<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function store(array $validated): void
    {
        $validated['user_id'] = Auth::id();
        Post::create($validated);
    }

    public function update(array $validated, Post $post): void
    {
        if (Auth::guard('admin')->check()) {
            $validated['user_id'] = Auth::guard('admin')->id();
        } elseif (Auth::guard('user')->check()) {
            $validated['user_id'] = Auth::guard('user')->id();
        }

        $post->update($validated);
    }
}
