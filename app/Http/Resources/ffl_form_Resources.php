<?php

namespace App\HTTp\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ffl_form_Resources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'form_4473_id' => $this->form_4473_id,
            'tenant' => $this->tenant ? $this->tenant->name : null,
            'customer' => $this->customer ? $this->customer->full_name : null,
            'nicks_transaction_number' => $this->nicks_transaction_number,
            'nicks_response' => $this->nicks_response,
            'nicks_response_date' => $this->nicks_response_date,
            'is_valid' => $this->is_valid,
            'is_multiple_firearm_sale' => $this->is_multiple_firearm_sale,
            'note' => $this->note,
            'firearms' => $this->firearms ? collect($this->firearms)->map(function ($item) {
                return [
                    'serial_number' => $item->serial_number ?? null,
                    'manufacturer' => $item->manufacturer ?? null,
                    'model' => $item->model ?? null,
                    'caliber_gauge' => $item->caliber_gauge ?? null,
                    'firearm_type' => $item->firearm_type ?? null,
                    'status' => $item->status ?? null,
                    'ffl_licensees' => $item->ffl_licensees ? [
                        'location' => $item->ffl_licensees->locations->name ?? null,
                        'ffl_number' => $item->ffl_licensees->ffl_number ?? null,
                        'licensee_name' => $item->ffl_licensees->licensee_name ?? null,
                        'expiration_date' => $item->ffl_licensees->expiration_date ?? null,
                        'license_type' => $item->ffl_licensees->license_type ?? null,
                        'phone' => $item->ffl_licensees->phone ?? null,
                        'email' => $item->ffl_licensees->email ?? null,
                        'address' => $item->ffl_licensees->address ?? null,
                        'city' => $item->ffl_licensees->city ?? null,
                        'state' => $item->ffl_licensees->state ?? null,
                        'zip_code' => $item->ffl_licensees->zip_code ?? null,
                    ] : null,
                    'notes' => $item->notes ?? null,
                ];
            }) : null,
            'order_items' => $this->order_items ? collect($this->order_items)->map(function ($item) {
                return [
                    'product' => $item->product ? $item->product->name : null,
                    'order_item_id' => $item->order_item_id ?? null,
                    'order_id' => $item->order_id ?? null,
                    'variant' => $item->varinat ? $item->varinat->name : 'no variant',
                    'quantity' => $item->quantity ?? null,
                    'unit_price' => $item->unit_price ?? null,
                    'discount_per_item' => $item->discount_per_item ?? null,
                    'tax_per_item' => $item->tax_per_item ?? null,
                    'line_total' => $item->line_total ?? null
                ];
            }) : null

        ];
    }
}
