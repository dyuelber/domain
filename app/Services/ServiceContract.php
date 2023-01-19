<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface ServiceContract
{
    public function create(array $data): Model;

    public function update(array $data, string $id): Model;

    public function delete(string $id): bool;
}
