<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request){
        return [
            'product_id'=>$this->product_id,
            'name'=>$this->name,
            'sku'=>$this->sku,
            'brand'=>$this->brand,
            'base_price'=>$this->base_price,
            'cost_price'=>$this->cost_price,
            'description'=>$this->description,
            'image_url'=>$this->image_url,
            'weight'=>$this->weight,
            'dimensions'=>$this->dimensions,
          'tenant_name' => $this->tenant->name ?? null,
        'category_name' => $this->category->name ?? null,
        'tax_rate' => $this->tax->rate ?? null,
        ];

    }
}