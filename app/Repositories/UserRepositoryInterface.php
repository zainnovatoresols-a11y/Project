<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();
    public function create(array $data);
}
