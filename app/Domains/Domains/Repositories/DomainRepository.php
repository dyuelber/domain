<?php

namespace App\Domains\Domains\Repositories;

use App\Domains\Abstracts\Repositories\AbstractRepository;
use App\Models\Domain;

class DomainRepository extends AbstractRepository
{
    public function __construct(Domain $model)
    {
        $this->model = $model;
    }
}
