<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Products;
use App\Exceptions\ProductException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\product_variants;
use APp\Models\inventory;

class AddInventoryAction
{
    public function handle($data)
    {
        try {
                $created = inventory::create([
                    'tenant_id' => $data['tenant_id'],
                    'location_id' => $data['location_id'],
                    'product_id' => $data['product_id'],
                    'variant_id' => $data['variant_id'],
                    'quantity' => $data['quantity'],
                    'reorder_point'=> $data['reorder_point'],
                    'last_restock_date'=> $data['last_restock_date']?? null,
                ]);
                return $created;
            } catch (ProductException $e) {
            throw $e;
        } catch (\Throwable $e) {
             return response()->json(['error' => 'An error occurred while adding inventory', $e->getMessage()], 500);
        }
    }
}
