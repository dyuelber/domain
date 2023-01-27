<?php

namespace App\Http\Controllers\User;

use App\Domains\Users\Services\TokenService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\User\UpdateToken;

class TokenController extends AbstractController
{
    public function __construct(TokenService $service)
    {
        $this->service       = $service;
        $this->requestUpdate = UpdateToken::class;
    }
}
