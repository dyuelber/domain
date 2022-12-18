<?php

namespace App\Services;

use App\Models\Domain;
use Illuminate\Support\Facades\Cache;

class CreateDomain
{
    public function handle(array $data): array
    {
        try {
            $domain = new Domain($data);
            $domain->user()->associate(auth()->user());
            $domain->save();

            Cache::put($domain->current, $domain->current);
        } catch (\Throwable $th) {
            throw $th;
        }

        return [
            'current' => $domain->current,
            'old' => $domain->old,
            'full_url' => 'https://'.$domain->current.'.'.config('app.domain'),
        ];
    }
}
