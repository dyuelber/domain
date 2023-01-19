<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function abilities(): array
    {
        return config('sanctum.abilities');
    }
}
