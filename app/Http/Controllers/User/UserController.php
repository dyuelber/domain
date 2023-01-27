<?php

namespace App\Http\Controllers\User;

use App\Domains\Users\Services\UserService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\User\UpdateUser;

class UserController extends AbstractController
{
    public function __construct(UserService $userService)
    {
        $this->service       = $userService;
        $this->requestUpdate = UpdateUser::class;
    }
}
