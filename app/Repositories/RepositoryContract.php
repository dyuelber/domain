<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryContract
{
    public function find(string $id): ?Model;

    public function findByKey(string $key, string $value): ?Model;

    public function all(int $perPage);

    public function create(array $data): Model;

    public function update(array $data, string $id): Model;

    public function delete(string $id): bool;
}
