<?php

namespace App\Http\Controllers\Domain;

use App\Domains\Domains\Services\DomainService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\RequestDomain;

class DomainController extends AbstractController
{
    public function __construct(DomainService $service)
    {
        $this->service       = $service;
        $this->requestCreate = RequestDomain::class;
    }
}
