<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\RequestDomain;
use App\Repositories\DomainRepository;
use App\Services\DomainService;
use Illuminate\Http\Request;

class DomainController extends AbstractController
{
    public function __construct()
    {
        $this->repository = new DomainRepository();
        $this->service    = new DomainService();
        $this->request    = new RequestDomain();
    }

    public function idParam(Request $request): string
    {
        return $request->id
            ?? $request->uuid
            ?? $request->current;
    }
}
