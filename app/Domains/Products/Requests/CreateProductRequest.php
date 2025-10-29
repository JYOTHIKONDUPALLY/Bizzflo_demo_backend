<?php

namespace App\Domains\Products\Requests;

use App\Domains\Products\Models\products;
use App\Http\Requests\BaseApiRequest;

class CreateProductRequest extends BaseApiRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
            "product_id"=>"string|nullable",
            "name" => "required|string",
            "sku"=>"required|string",
            "category_id"=> "required | string",
            "brand"=>"required|string",
            "base_price"=>"required|numeric",
            "cost_price"=>"required|numeric",
            "description"=>"string",
            "image_url"=>"string",
            "weight"=>"numeric",
            "dimensions"=>"string",
            "tenant_id"=>"required|string",
            "category_id"=>"required|string",
            "tax_rate_id"=>"required|string",
            "variants"=>"array ",
            "variants.*.price_difference"=>"required|numeric|min:0",
            "variants.*.sku_suffix"=>"required|string",
            "variants.*.name"=>"required|string",
        ];
    }
}
?>