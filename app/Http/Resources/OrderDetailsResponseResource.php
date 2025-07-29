<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResponseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'order_id' => $this->order_id,
            'order_details' => [

                'order_status' => $this->status,
                'order_type' => $this->order_type,
                'order_subtotal' => $this->subtotal,
                'discount_amount' => $this->discount_amount,
                'tax_amount' => $this->tax_amount,
                'shipping_cost' => $this->shipping_cost,
                'total_amount' => $this->total_amount,
                'payment_status' => $this->payment_status,
                'payment_method' => $this->payment_method,
            ],

            'order_items' => $this->order_items ?  collect($this->order_items)->map(function ($item) {
                return [
                    'product' => $item->product->name ?? null,
                    'order_item_id' => $item->order_item_id,
                    'variant' => $item->variant->name ?? null,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'discount_per_item' => $item->discount_per_item,
                    'tax_per_item' => $item->tax_per_item,
                    'line_total' => $item->line_total
                ];
            }) : [],
            'customer_details' => $this->customer_details ? [
                'customer_id' => $this->customer_details->customer_id,
                'full_name' => $this->customer_details->full_name,
                'email' => $this->customer_details->email,
                'phone' => $this->customer_details->phone
            ] : null,
            'shipping_address' => $this->customer_shipping_addresses
                ? [
                    'address1' => $this->customer_shipping_addresses->address_line1 ?? '',
                    'address2' => $this->customer_shipping_addresses->address_line2 ?? '',
                    'city' => $this->customer_shipping_addresses->city ?? '',
                    'state' => $this->customer_shipping_addresses->state ?? '',
                    'zipcode' => $this->customer_shipping_addresses->zip_code ?? '',
                    'country' => $this->customer_shipping_addresses->country ?? '',
                    'address_type' => $this->customer_shipping_addresses->address_type ?? '',
                ]
                : null,
            'billing_address' => $this->customer_billing_address
                ? [
                    'address1' => $this->customer_billing_address->address_line1 ?? '',
                    'address2' => $this->customer_billing_address->address_line2 ?? '',
                    'city' => $this->customer_billing_address->city ?? '',
                    'state' => $this->customer_billing_address->state ?? '',
                    'zipcode' => $this->customer_billing_address->zip_code ?? '',
                    'country' => $this->customer_billing_address->country ?? '',
                    'address_type' => $this->customer_billing_address->address_type ?? '',
                ]
                : null,
            'payment_details' => $this->payment_details ? [
                'payment_id' => $this->payment_details->payment_id,
                'amount' => $this->payment_details->amount,
                'payment_method' => $this->payment_details->payment_method,
                'transaction_id' => $this->payment_details->transaction_id,
                'status' => $this->payment_details->status,
                'payment_date' => $this->payment_details->payment_date,
                'notes' => $this->payment_details->notes
            ] : null
        ];
    }
}
