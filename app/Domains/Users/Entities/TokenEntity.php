<?php

namespace App\Domains\Users\Entities;

use Laravel\Sanctum\PersonalAccessToken;

class TokenEntity extends PersonalAccessToken
{
    protected $table = 'personal_access_tokens';

    protected $hidden = [
        'id',
        'token',
        'tokenable_type',
        'tokenable_id',
        'updated_at',
    ];
}
