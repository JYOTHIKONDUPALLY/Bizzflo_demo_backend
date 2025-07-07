<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class multipleSalesResource extends JsonResource
{
  
    public function toArray($request)
    {
        return [
            'multiple_sale_form_id'=>$this->multiple_sale_form_id,
            'tenant'=>$this->tenant ? $this->tenant->name : null,
            'customer'=>$this->customer ? $this->customer->full_name : null,
            'form_type'=>$this->form_type,
            'created_by_user'=>$this->user->full_name ?? null,
            'submission_date'=>$this->submission_date,
            'atf_control_number'=>$this->atf_control_number,
            'status'=>$this->status,
            'notes'=>$this->notes,
            'firearms'=>$this->firearms ? collect($this->firearms)->map(function ($item) { 
                return [
                    'serial_number'=>$item->serial_number,
                    'manufacturer'=>$item->manufacturer,
                    'model'=>$item->model,
                    'caliber_gauge'=>$item->caliber_gauge,
                    'firearm_type'=>$item->firearm_type,
                    'status'=>$item->status,
                    'ffl_licensee'=>$item->ffl_licensee ? [
                        'location' => $item->ffl_licensee->locations->name ?? null,
                        'ffl_number' => $item->ffl_licensee->ffl_number ?? null,
                        'licensee_name' => $item->ffl_licensee->licensee_name ?? null,
                        'expiration_date' => $item->ffl_licensee->expiration_date ?? null,
                        'license_type' => $item->ffl_licensee->license_type ?? null,
                        'phone' => $item->ffl_licensee->phone ?? null,
                        'email' => $item->ffl_licensee->email ?? null,
                        'address' => $item->ffl_licensee->address ?? null,
                        'city' => $item->ffl_licensee->city ?? null,
                        'state' => $item->ffl_licensee->state ?? null,
                        'zip_code' => $item->ffl_licensee->zip_code ?? null,
                        
                     ] : null,
                      'notes' => $item->notes ?? null,
                ];}) : null,
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