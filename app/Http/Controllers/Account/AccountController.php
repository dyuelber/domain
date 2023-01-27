<?php

namespace App\Http\Controllers\Account;

use App\Domains\Accounts\Services\AccountService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Account\CreateAccount;

class AccountController extends AbstractController
{
    public function __construct(AccountService $service)
    {
        $this->service       = $service;
        $this->requestCreate = CreateAccount::class;
    }
}
