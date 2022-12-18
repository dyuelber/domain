<?php

namespace App\Repositories;

use App\Models\Domain;

class DomainRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Domain();
    }
}
