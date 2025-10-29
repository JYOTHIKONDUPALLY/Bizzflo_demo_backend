<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResponseResource extends JsonResource
{
    public function toArray($request){
        return [
            'product_id' =>$this->product_id,
            'tenant'=>$this->tenant->name ?? null,
            'name'=>$this->name,
            'sku'=>$this->sku,
            'category'=>$this->category->name,
            'brand'=>$this->brand,
            'base_price'=>$this->base_price,
            'cost_price'=>$this->cost_price,
            'description'=>$this->description,
            'image_url'=>$this->image_url,
            'weight'=>$this->weight,
            'dimensions'=>$this->dimensions,
            'tax_rate'=>$this->tax->rate ?? null,
            'is_ffl_item' => $this->is_ffl_item,
            'requires_background_check' => $this->requires_background_check,
            'status' => $this->status
        ];
    }
}