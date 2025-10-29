<?php

namespace App\Domains\Products\Requests;

use App\Http\Requests\BaseApiRequest;

class UpdateInventoryRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $locationId = $this->route('locationId'); 

        return [
            'tenant_id' => 'sometimes|exists:tenants,tenant_id',
            'product_id' => 'sometimes|exists:products,id',
            'location_id' => 'sometimes|exists:locations,location_id',
            'variant_id' => 'sometimes|exists:product_variants,variant_id',
            'reorder_point' => 'sometimes|numeric|min:0',
            'last_restock_date' => 'sometimes|date',
        ];

    }
}
