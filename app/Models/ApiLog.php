<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ApiLog extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
        'user_id',
    ];

    protected $fillable = [
        'user_id',
        'ip',
        'method',
        'url',
        'code',
        'duration',
        'controller',
        'action',
        'payload',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
