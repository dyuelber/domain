<?php

namespace App\Domains\Users\Services;

use App\Domains\Abstracts\Services\AbstractService;
use App\Domains\Users\Repositories\TokenRepository;
use App\Exceptions\MissingParameterException;

class TokenService extends AbstractService
{
    public function __construct(TokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(int $perPage = null)
    {
        return ['abilities' => config('sanctum.abilities')];
    }

    public function validateUpdate(array $data, string $id): void
    {
        if (! data_get($data, 'abilities')) {
            throw new MissingParameterException('abilities');
        }
    }
}
