<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\AbstractController;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserController extends AbstractController
{
    public function __construct()
    {
        $this->service = new UserService();
        $this->repository = new UserRepository();
    }
}
