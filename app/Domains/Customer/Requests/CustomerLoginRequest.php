<?php

namespace App\Domains\Customer\Requests;

use App\Http\Requests\BaseApiRequest;

class CustomerLoginRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ];
    }
}
