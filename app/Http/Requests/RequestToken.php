<?php

namespace App\Http\Requests;

class RequestToken extends AbstractRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): mixed
    {
        return [
            'email'     => 'required|email',
            'password'  => 'required|string|min:6',
            'abilities' => 'required|array',
        ];
    }
}
