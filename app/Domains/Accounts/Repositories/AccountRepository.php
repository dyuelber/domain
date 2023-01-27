<?php

namespace App\Domains\Accounts\Repositories;

use App\Domains\Abstracts\Repositories\AbstractRepository;
use App\Models\User;

class AccountRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
