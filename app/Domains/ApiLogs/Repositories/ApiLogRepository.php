<?php

namespace App\Domains\ApiLogs\Repositories;

use App\Domains\Abstracts\Repositories\AbstractRepository;
use App\Models\ApiLog;

class ApiLogRepository extends AbstractRepository
{
    public function __construct(ApiLog $model)
    {
        $this->model = $model;
    }
}
