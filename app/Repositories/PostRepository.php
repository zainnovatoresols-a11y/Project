<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getAll()
    {
        return Post::with('user')->latest()->paginate(5);
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function find(Post $post): Post
    {
        return $post;
    }

    public function update(Post $post, array $data): bool
    {
        return $post->update($data);
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }

    public function getPostComments(Post $post)
    {
        return $post->comments()
            ->with('user')
            ->latest()
            ->paginate(5);
    }
}
