<?php

namespace App\Domains\Abstracts\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function find(string $id): ?Model;

    public function findByKey(string $key, string $value): ?Model;

    public function all(int $perPage);

    public function create(array $data): Model;

    public function update(array $data, string $id): Model;

    public function delete(string $id): bool;
}
