<?php

namespace App\Domains\Domains\Services;

use App\Domain\Abstracts\Services\AbstractService;
use App\Domains\Domains\Repositories\DomainRepository;
use App\Exceptions\MissingParameterException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class DomainService extends AbstractService
{
    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeCreate(array $data): array
    {
        $this->validateCreate($data);

        return $data;
    }

    public function validateCreate(array &$data)
    {
        if (! data_get($data, 'current')) {
            throw new MissingParameterException('current');
        }
    }

    public function afterCreate(Model $model, array $data): mixed
    {
        $model->user()->associate(auth()->user());
        $model->save();

        Cache::put($model->current, $model->current);

        return null;
    }

    public function beforeUpdate(array $data, string &$id): array
    {
        $this->validateUpdate($data, $id);

        Cache::forget($data['old']);

        $domain = $this->repository->findByKey('current', $id);
        $id     = (string) $domain->id;

        return $data;
    }

    public function validateUpdate(array &$data, string &$id)
    {
        if (! data_get($data, 'old')) {
            throw new MissingParameterException('old');
        }
        if (! data_get($data, 'current')) {
            throw new MissingParameterException('current');
        }
    }

    public function afterUpdate(Model $model, array $data): mixed
    {
        Cache::put($model->current, $model->current);

        return null;
    }

    public function delete(string $id): bool
    {
        $domain = $this->repository->findByKey('current', $id);
        $this->repository->delete((string) $domain->id);

        return Cache::forget($domain->current);
    }
}
