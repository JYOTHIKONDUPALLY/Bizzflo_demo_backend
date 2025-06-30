<?php

namespace App\Domains\Cart\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules():array
    {
     return [
        "order_id" => 'required|exists:orders,order_id',
        'customer_id' => 'sometimes|exists:customers,customer_id',
        "billing_address_id" =>'required|exists:customer_addresses,address_id',
        'shipping_address_id' => 'required|exists:customer_addresses,address_id'
     ];
    }
}