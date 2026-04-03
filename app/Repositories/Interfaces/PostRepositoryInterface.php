<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAll();
    public function create(array $data): Post;
    public function update(Post $post, array $data): bool;
    public function delete(Post $post): bool;
}
