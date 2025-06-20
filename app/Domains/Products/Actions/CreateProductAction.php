<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Products;

class CreateProductAction
{
    public function handle($data)
    {
            if ($data['product_id']) {
                $product = Products::where('product_id', $data['product_id'])->first();
                if (!$product) {
                    // Handle case where product doesn't exist
                    throw new \Exception('Product not found');
                }
                $product->update($data);
                return $product;
            }
            return Products::create([
                'name' => $data['name'],
                'sku' => $data['sku'],
                'brand' => $data['brand'],
                'base_price' => $data['base_price'],
                'cost_price' => $data['cost_price'],
                'description' => $data['description'] ?? null,
                'image_url' => $data['image_url'] ?? null,
                'weight' => $data['weight'] ?? null,
                'dimensions' => $data['dimensions'] ?? null,
                'tenant_id' => $data['tenant_id'],
                'category_id' => $data['category_id'],
                'tax_rate_id' => $data['tax_rate_id'],
            ]);
    }
}
