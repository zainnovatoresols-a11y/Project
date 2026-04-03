<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    public function store(array $validated): void
    {
        $validated['user_id'] = Auth::id();
        $this->postRepository->create($validated);
    }

    public function show(Post $post)
    {
        return [
            'post' => $post,
            'comments' => $this->postRepository->getPostComments($post)
        ];
    }

    public function update(array $validated, Post $post): void
    {
        $this->postRepository->update($post, $validated);
    }

    public function delete(Post $post): void
    {
        $this->postRepository->delete($post);
    }
}