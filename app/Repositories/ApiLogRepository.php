<?php

namespace App\Repositories;

use App\Models\ApiLog;

class ApiLogRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new ApiLog();
    }
}
