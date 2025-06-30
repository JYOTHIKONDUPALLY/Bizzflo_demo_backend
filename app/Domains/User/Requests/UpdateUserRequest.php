<?php

namespace App\Domains\User\Requests;

use App\Http\Requests\BaseApiRequest;

class UpdateUserRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('userId');
        return [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => "sometimes|email|unique:tenants,email,{$userId},tenant_id",
            'role_id' => 'sometimes|string|max:255',
            'location_id' => 'sometimes|string|max:255',
            'tenant_id' => 'sometimes|string|max:255',
        ];
    }
}
