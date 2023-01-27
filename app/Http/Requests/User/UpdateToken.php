<?php

namespace App\Http\Requests\User;

use App\Http\Requests\AbstractRequest;

class UpdateToken extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): mixed
    {
        return [
            'abilities' => 'required|array',
        ];
    }
}
