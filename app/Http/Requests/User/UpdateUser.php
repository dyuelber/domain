<?php

namespace App\Http\Requests\User;

use App\Http\Requests\AbstractRequest;

class UpdateUser extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): mixed
    {
        return [
            'name'     => 'string|max:256',
            'email'    => 'email',
            'password' => 'string|min:6',
        ];
    }
}
