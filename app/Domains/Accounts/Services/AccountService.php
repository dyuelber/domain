<?php

namespace App\Domains\Accounts\Services;

use App\Domains\Abstracts\Services\AbstractService;
use App\Domains\Accounts\Repositories\AccountRepository;
use App\Exceptions\MissingParameterException;
use Illuminate\Database\Eloquent\Model;

class AccountService extends AbstractService
{
    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeCreate(array $data): array
    {
        $data['password'] = bcrypt($data['password']);

        return $data;
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

    public function afterCreate(Model $model, array $data): mixed
    {
        $expire         = config('sanctum.c-expiration');
        $token          = $model->createToken($data['email'], data_get($data, 'abilities', ['basic-user']), $expire);
        $model->token   = $token->plainTextToken;
        $model->expires = $expire->toDateTimeString();

        $this->update($model->id, ['token' => $model->token]);

        return null;
    }
}
