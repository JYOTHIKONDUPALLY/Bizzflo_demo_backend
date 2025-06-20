<?php

namespace App\Domains\Customer\Requests;

use App\Http\Requests\BaseApiRequest;

class CustomerRegisterRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'tenant_id' => 'required|string|max:225',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|string'
        ];
    }
}
