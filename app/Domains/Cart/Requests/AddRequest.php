<?php

namespace App\Domains\Cart\Requests;
use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order_id' => 'sometimes|string|exists:orders,order_id',
            'customer_id' => 'sometimes|string|exists:customers,customer_id',
            'product_id' => 'required|string|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'order_type' => 'required|string',
            'variant_id' =>'sometimes|string|exists:product_variants,variant_id',
            'discount_per_items'=>'sometimes|numeric|min:0',
            'tax_per_items' => 'sometimes|numeric|min:0',
        ];
    }
}
?>