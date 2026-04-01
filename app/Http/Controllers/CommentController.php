<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function store(Request $request, Post $post, CommentService $commentService)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $response = $commentService->storeComment($post, $request->comment);

        if (!$response['status']) {
            return back()->with('error', $response['message']);
        }

        return back()->with('success', $response['message']);
    }

    public function show(Post $post)
    {
        $comments = $post->comments()
            ->with('user')
            ->latest();

        return view('post.show', compact('post', 'comments'));
    }
}