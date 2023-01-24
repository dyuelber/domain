<?php

namespace App\Domains\Abstracts\Repositories;

use App\Domain\Abstracts\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    public const PER_PAGE = 10;

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find(string $id): ?Model
    {
        if (is_numeric($id)) {
            return $this->findByKey('id', $id);
        }

        return $this->findByKey('uuid', $id);
    }

    public function findByKey(string $key, string $value): ?Model
    {
        return $this->model->where($key, $value)->first();
    }

    public function all(int $perPage = self::PER_PAGE)
    {
        return $this->model->query()->simplePaginate($perPage);
    }

    public function create(array $data): Model
    {
        $this->model->fill($data);
        $this->model->save();

        return $this->model;
    }

    public function update(array $data, string $id): Model
    {
        $model = $this->find($id);

        $model->fill($data);
        $model->save();

        return $model;
    }

    public function delete(string $id): bool
    {
        $model = $this->find($id);

        return $model->delete();
    }
}
