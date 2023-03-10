<?php

namespace App\Domains\Abstracts\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    public function create(array $data): Model;

    public function update(string $id, array $data): Model;

    public function delete(string $id): bool;
}
