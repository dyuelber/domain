<?php

namespace App\Domains\Abstracts\Services;

use App\Domain\Abstracts\Interfaces\ServiceInterface;
use App\Domains\Abstracts\Repositories\AbstractRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class AbstractService implements ServiceInterface
{
    protected AbstractRepository $repository;

    public function all(int $perPage)
    {
        return $this->repository->all($perPage);
    }

    public function find(string $id): ?Model
    {
        $response = $this->repository->find($id);
        if (! $response) {
            throw new Exception('Object not found in databse');
        }

        return $response;
    }

    public function validateCreate(array $data): void
    {
    }

    public function beforeCreate(array $data): array
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

            $this->validateCreate($data);
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

    public function validateUpdate(array $data, string $id): void
    {
    }

    public function beforeUpdate(array $data, string &$id): array
    {
        return $data;
    }

    public function afterUpdate(Model $model, array $data): mixed
    {
        return null;
    }

    public function update(array $data, string $id): Model
    {
        try {
            DB::beginTransaction();

            $this->validateUpdate($data, $id);
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

    public function validateDelete(string $id): void
    {
    }

    public function beforeDelete(string $id)
    {
        return $id;
    }

    public function delete(string $id): bool
    {
        try {
            DB::beginTransaction();

            $this->validateDelete($id);
            $this->beforeDelete($id);
            $response = $this->repository->delete($id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $response;
    }
}
