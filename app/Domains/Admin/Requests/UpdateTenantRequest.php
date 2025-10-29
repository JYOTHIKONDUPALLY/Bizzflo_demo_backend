<?php

namespace App\Domains\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $tenantId = $this->route('tenant_id'); 

        return [
            'name' => 'sometimes|string|max:255',
            'email' => "sometimes|email|unique:tenants,email,{$tenantId},tenant_id",
            'subdomain' => "sometimes|string|unique:tenants,subdomain,{$tenantId},tenant_id",
            'status' => 'sometimes|in:active,inactive',
            'address' => 'nullable|string',
        ];
    }
}
