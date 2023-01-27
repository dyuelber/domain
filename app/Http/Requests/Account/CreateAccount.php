<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\AbstractRequest;

class CreateAccount extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): mixed
    {
        return [
            'name'     => 'required|string|max:256',
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }
}
