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
<<<<<<< HEAD
              'order_id' => 'sometimes|exists:orders,id',
            //   'tenant_id'=> 'sometimes|exists:tenants,tenant_id',
            //   'location_id'=> 'sometimes|exists:locations,location_id',
              'customer_id'=> 'sometimes|exists:customers,customer_id',
              'order_type'=>'sometimes|in : E-commerce,POS',
              'status'=>'sometimes|in : Pending, Processing,Completed,Refunded,Canceled,Cart',
=======
              'customer_id'=> 'sometimes|exists:customers,customer_id',
              'order_type'=>'string|in :E-commerce,POS|nullable',
              'order_status'=>'string|in :Pending,Processing,Completed,Refunded,Cancelled,Cart|nullable',
              'payment_status'=>'string|in :Paid,partially Paid,Refunded,Pending|nullable',
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
              'shipping_address_id'=>'sometimes|exists:shipping_addresses,shipping_address_id',
              'billing_address_id'=>'sometimes|exists:billing_addresses,billing_address_id',

        ];

    }
}