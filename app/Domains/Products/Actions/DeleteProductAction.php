<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Products;

class DeleteProductAction
{
    public function handle($id)
    {
        try {
            $product = Products::where('product_id', $id->product_id)->first();
            if (!$product) {
                throw new \Exception('Product not found');
            }
            $product->delete();
            return $product;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
