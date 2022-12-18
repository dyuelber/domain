<?php

namespace App\Services;

use App\Models\Domain;
use Illuminate\Support\Facades\Cache;

class UpdateDomain
{
    public function handle(array $data): array
    {
        try {
            Cache::forget($data['old']);

            $domain = Domain::where('current', $data['old'])->first();

            $domain->current = $data['current'];
            $domain->old = $data['old'];

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
