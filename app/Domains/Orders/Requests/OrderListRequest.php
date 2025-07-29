<?php

namespace App\Domains\Orders\Requests;

use App\Domains\Orders\Models\Order;
use App\Http\Requests\BaseApiRequest;
use App\Domains\Orders\Models\order_items;

class OrderListRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
              'customer_id'=> 'sometimes|exists:customers,customer_id',
              'order_type'=>'string|in :E-commerce,POS|nullable',
              'order_status'=>'string|in :Pending,Processing,Completed,Refunded,Cancelled,Cart|nullable',
              'payment_status'=>'string|in :Paid,partially Paid,Refunded,Pending|nullable',
              'shipping_address_id'=>'sometimes|exists:shipping_addresses,shipping_address_id',
              'billing_address_id'=>'sometimes|exists:billing_addresses,billing_address_id',

        ];

    }
}