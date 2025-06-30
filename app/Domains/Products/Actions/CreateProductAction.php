<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Products;
use App\Exceptions\ProductException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\product_variants;

class CreateProductAction
{
    public function handle($data)
    {
        try {

            if ($data['product_id']) {
                $product = Products::findorFail($data['product_id']);
                $product->update($data);
                return $product;
            } else {
                $created = Products::create([
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
                if ($data['variants']) {
                    product_variants::create([
                        'product_id' => $created->product_id,
                        'name' => $data['variants'][0]['name'],
                        'sku_suffix' => $data['variants'][0]['sku_suffix'],
                        'additional_price' => $data['variants'][0]['price_difference']
                    ]);
                }
                return $created;
            }
        } catch (AuthenticationException $e) {
            throw $e;
        } catch (ModelNotFoundException $e) {
            throw ProductException::notFound();
        } catch (ProductException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw ProductException::creationFailed($e->getMessage());
        }
    }
}
