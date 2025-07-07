<?php

namespace App\Domains\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $locationId = $this->route('locationId'); 

        return [
            'name' => 'sometimes|string|max:255',
            'email' => "sometimes|email|unique:tenants,email,{$locationId},tenant_id",
            'is_ecommerce_enabled' => 'sometimes|1,0',
            'is_pos_enabled'=>'sometimes|1,0',
            'address' => 'nullable|string',
            'phone'=> 'nullable|string',
        ];
    }
}
