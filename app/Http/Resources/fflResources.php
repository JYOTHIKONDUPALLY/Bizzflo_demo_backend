<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class fflResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tenant'=>$this->tenant->name ?? null,
            'licensee'=>$this->ffl_licensee->licensee_name ?? null,
            'firearm'=>$this->firearm->product->name??null,
            'entry_type'=>$this->entry_type,
            'date_of_transaction'=>$this->date_of_transaction,
            'from_whom_acquired_or_to_whom_disposed'=>$this->from_whom_acquired_or_to_whom_disposed,
            'address_of_party'=>$this->address_of_party,
            'city_of_party'=>$this->city_of_party,
            'state_of_party'=>$this->state_of_party,
            'type_of_identification'=>$this->type_of_identification,
            'id_number'=>$this->id_number,
            'state_of_id'=>$this->state_of_id,
            'order_id'=>$this->order_id,
            'notes'=>$this->notes,
            'created_by_user'=>$this->user->full_name ?? null,
            'audit_trail_json'=>$this->audit_trail_json,
              'order_items' => $this->order_items ? collect($this->order_items)->map(function ($item) {
                return [
                    'product' => $item->product->name ?? null,
                    'order_item_id' => $item->order_item_id,
                    'order_id' => $item->order_id,
                    'variant' => $item->varinat->name ?? 'no variant',
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'discount_per_item' => $item->discount_per_item,
                    'tax_per_item' => $item->tax_per_item,
                    'line_total' => $item->line_total
                ];
            }):null
        ];
    }
}

 