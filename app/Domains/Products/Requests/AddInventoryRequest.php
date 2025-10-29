<?php

namespace App\Domains\Products\Requests;

use App\Domains\Products\Models\Product;
use App\Http\Requests\BaseApiRequest;

class AddInventoryRequest extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
            'tenant_id' => 'required|exists:tenants,tenant_id',
            'location_id' => 'required|exists:locations,location_id',
            'inventory_id' => 'required|exists:inventory,inventory_id',
            'variant_id' => 'required|exists:product_variants,variant_id',
            'reorder_point' => 'required|numeric|min:0',
            'last_restock_date' => 'nullable|date',

        ];
    }
}