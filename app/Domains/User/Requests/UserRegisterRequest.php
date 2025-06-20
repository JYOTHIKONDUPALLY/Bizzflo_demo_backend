<?php

namespace App\Domains\User\Requests;

use App\Http\Requests\BaseApiRequest;

class UserRegisterRequest extends BaseApiRequest
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
            'role_id' => 'required|string|max:255',
            'location_id' => 'required|string|max:255',
            'tenant_id' => 'required|string|max:225',
            'email' => 'required|string|email|max:225|unique:users',
            'password' => 'required|string|min:8'
        ];
    }
}
