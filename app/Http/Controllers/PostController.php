<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;   
    public function index()
    {
        // $posts = Post::with('user')->latest()->paginate(2);
        $posts = Post::latest()->paginate(2);
        $posts->load('user');
        // dd($posts);
        return view('post.index', compact('posts'));
    }

    public function create(): View
    {
        return view('post.create');
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        
        $validated['user_id'] = Auth::id();
        $post = Post::create($validated);

        return redirect()->route('post.index')
            ->with('success', 'Post created successfully.');
    }


    public function show(Post $post): View

    {
        $comments = $post->comments()
            ->with('user')
            ->latest()
            ->paginate(5);

        return view('post.show', compact('post', 'comments'));
    }

    public function edit(Post $post): View
    {
        $this->authorize('post.edit', $post);
        return view('post.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('post.edit', $post);
        $validated = $request->validated();

        if (Auth::guard('admin')->check()) {
            $validated['user_id'] = Auth::guard('admin')->id();
        } elseif (Auth::guard('user')->check()) {
            $validated['user_id'] = Auth::guard('user')->id();
        }

        $post->update($validated);

        return redirect()->route('post.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('post.delete', $post);
        $post->delete();

        return redirect()->route('post.index')
            ->with('success', 'Post deleted successfully');
    }
}
