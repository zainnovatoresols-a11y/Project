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
use App\Services\PostService;


class PostController extends Controller
{
    use AuthorizesRequests;   
    public function index(PostService $postService)
    {
        // $posts = Post::with('user')->latest()->paginate(2);
        // $posts = Post::latest()->paginate(2);
        // $posts->load('user');
        // dd($posts);

        $posts = $postService->getAllPosts();
        return view('post.index', compact('posts'));
    }

    public function create(): View
    {
        return view('post.create');
    }

    public function store(PostStoreRequest $request, PostService $postService)
    {
        $postService->store($request->validated());

        return redirect()->route('post.index')
            ->with('success', 'Post created successfully.');
    }


    public function show(Post $post, PostService $postService)
    {
        $data = $postService->show($post);

        return view('post.show', $data);
    }

    public function edit(Post $post): View
    {
        $this->authorize('post.edit', $post);
        return view('post.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, Post $post, PostService $postService)
    {
        $this->authorize('post.edit', $post);

        $postService->update($request->validated(), $post);

        return redirect()->route('post.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post, PostService $postService)
    {
        $this->authorize('post.delete', $post);

        $postService->delete($post);

        return redirect()->route('post.index')
            ->with('success', 'Post deleted successfully');
    }
}
