<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Abstracts\Repositories\AbstractRepository;
use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function abilities(): array
    {
        return config('sanctum.abilities');
    }
}
