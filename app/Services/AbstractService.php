<?php

namespace App\Services;

use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class AbstractService implements ServiceContract
{
    public function __construct(
        protected AbstractRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function beforeCreate(array $data): array
    {
        return $data;
    }

    public function validateCreate(array &$data)
    {
        return $data;
    }

    public function afterCreate(Model $model, array $data): mixed
    {
        return null;
    }

    public function create(array $data): Model
    {
        try {
            DB::beginTransaction();
            $data     = $this->beforeCreate($data);
            $response = $this->repository->create($data);
            $this->afterCreate($response, $data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $response;
    }

    public function beforeUpdate(array $data, string &$id): array
    {
        return $data;
    }

    public function validateUpdate(array &$data, string &$id)
    {
    }

    public function afterUpdate(Model $model, array $data): mixed
    {
        return null;
    }

    public function update(array $data, string $id): Model
    {
        try {
            DB::beginTransaction();
            $data     = $this->beforeUpdate($data, $id);
            $response = $this->repository->update($data, $id);
            $this->afterUpdate($response, $data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $response;
    }

    public function delete(string $id): bool
    {
        try {
            DB::beginTransaction();
            $response = $this->repository->delete($id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $response;
    }
}
