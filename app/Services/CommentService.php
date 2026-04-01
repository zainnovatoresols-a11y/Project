<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentService
{
    public function storeComment(Post $post, string $comment)
    {
        $user = Auth::guard('admin')->user() ?? Auth::guard('user')->user();

        if (!$user) {
            return [
                'status' => false,
                'message' => 'Login required'
            ];
        }

        $post->comments()->create([
            'user_id' => $user->id,
            'comment' => $comment
        ]);

        return [
            'status' => true,
            'message' => 'Comment added'
        ];
    }
}
