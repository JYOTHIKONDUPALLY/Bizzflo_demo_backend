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
<<<<<<< HEAD
            'customer' => $this->customer->name ?? null,
=======
            'customer' => $this->customer->full_name ?? null,
            'order_status' => $this->status,
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
            'order_date' => $this->order_date,
            'order_type' => $this->order_type,
            'subtotal' => $this->subtotal,
            'discount_amount' => $this->discount_amount,
            'tax_amount' => $this->tax_amount,
            'shipping_cost' => $this->shipping_cost,
            'total_amount' => $this->total_amount,
            'payment_status' => $this->payment_status,
<<<<<<< HEAD
            'payment_method' => $this->payment_method,
            'order_items' => collect($this->order_items)->map(function ($item) {
                return [
                    'product' => $item->product->name ?? null,
                    'order_item_id' => $item->order_item_id,
                    'order_id' => $item->order_id,
                    'variant' => $item->variant->name ?? null,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'discount_per_item' => $item->discount_per_item,
                    'tax_per_item' => $item->tax_per_item,
                    'line_total' => $item->line_total
                ];
            }),
            'shipping_address' => $this->customer_addresses
                ? implode(', ', array_filter([
                    $this->customer_addresses->addressline1 ?? '',
                    $this->customer_addresses->addressline2 ?? '',
                    $this->customer_addresses->zipcode ?? '',
                    $this->customer_addresses->city ?? '',
                    $this->customer_addresses->state ?? '',
                ]))
                : null,
            'status' => $this->status,
            'billing_address' => $this->customer_addresses
                ? implode(', ', array_filter([
                    $this->customer_addresses->addressline1 ?? '',
                    $this->customer_addresses->addressline2 ?? '',
                    $this->customer_addresses->zipcode ?? '',
                    $this->customer_addresses->city ?? '',
                    $this->customer_addresses->state ?? '',
                ]))
                : null,
=======
            'payment_method' => $this->payment_method
   
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
        ];
    }
}
