<?php

namespace App\Http\Requests;

class RequestDomain extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): mixed
    {
        return [
            'current' => 'required|string|min:5',
            'old' => 'nullable|string|min:5'
        ];
    }
}
