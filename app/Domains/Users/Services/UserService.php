<?php

namespace App\Domains\Users\Services;

use App\Domains\Abstracts\Services\AbstractService;
use App\Domains\Users\Repositories\UserRepository;
use App\Exceptions\MissingParameterException;

class UserService extends AbstractService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateCreate(array $data): void
    {
        if (! data_get($data, 'email')) {
            throw new MissingParameterException('email');
        }
        if (! data_get($data, 'password')) {
            throw new MissingParameterException('password');
        }
    }
}
