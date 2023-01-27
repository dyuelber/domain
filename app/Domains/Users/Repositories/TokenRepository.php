<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Abstracts\Repositories\AbstractRepository;
use App\Domains\Users\Entities\TokenEntity;
use Illuminate\Database\Eloquent\Model;

class TokenRepository extends AbstractRepository
{
    public function __construct(TokenEntity $model)
    {
        $this->model = $model;
    }

    public function find(string $id): ?Model
    {
        return $this->model->findToken($id);
    }
}
