<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $user = Auth::guard('admin')->user() ?? Auth::guard('user')->user();

        if (!$user) {
            return back()->with('error', 'Login required');
        }

        $post->comments()->create([
            'user_id' => $user->id,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Comment added');
    }

    public function show(Post $post)
    {
        $comments = $post->comments()
            ->with('user')
            ->latest();

        return view('post.show', compact('post', 'comments'));
    }
}