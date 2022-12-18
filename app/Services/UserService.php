<?php

namespace App\Services;

use App\Exceptions\MissingParameterException;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserService extends AbstractService
{
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function beforeCreate(array $data): array
    {
        $this->validateCreate($data);

        $data['name'] = $data['email'];
        $data['password'] = bcrypt($data['password']);

        return $data;
    }

    public function validateCreate(array &$data)
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
        $expire = config('sanctum.c-expiration');
        $token = $model->createToken($data['email'], data_get($data, 'abilities'), $expire);
        $model->token = $token->plainTextToken;
        $model->expires = $expire->toDateTimeString();

        return null;
    }

    public function beforeUpdate(array $data, string &$id): array
    {
        $this->validateUpdate($data, $id);

        $id = auth()->user()->id;

        return $data;
    }

    public function validateUpdate(array &$data, string &$id)
    {
        if (! data_get($data, 'abilities') || ! is_array($data['abilities'])) {
            throw new MissingParameterException('abilities');
        }
    }

    public function updateAbilities(array $data, string $id): Model
    {
        try {
            DB::beginTransaction();
            $data = $this->beforeUpdate($data, $id);

            $token = auth()->user()->tokens()->where('tokenable_id', $id)->first();
            $token->abilities = $data['abilities'];
            $token->expires_at = today()->addYear();
            $token->save();

            $this->afterUpdate($token, $data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $token;
    }
}
