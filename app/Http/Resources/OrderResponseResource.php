<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResponseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'order_id' => $this->order_id,
            'tenant' => $this->tenant->name ?? null,
            'location' => $this->location->name ?? null,
            'customer' => $this->customer->full_name ?? null,
            'order_status' => $this->status,
            'order_date' => $this->order_date,
            'order_type' => $this->order_type,
            'subtotal' => $this->subtotal,
            'discount_amount' => $this->discount_amount,
            'tax_amount' => $this->tax_amount,
            'shipping_cost' => $this->shipping_cost,
            'total_amount' => $this->total_amount,
            'payment_status' => $this->payment_status,
            'payment_method' => $this->payment_method
   
        ];
    }
}
