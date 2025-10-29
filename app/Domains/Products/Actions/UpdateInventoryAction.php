<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Products;
use App\Exceptions\ProductException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\product_variants;
use APp\Models\inventory;

class UpdateInventoryAction
{
    public function handle($data, $inventory_id)
    {
        try {
               $inventory = inventory ::findOrFail($data->inventory_id);
               $inventory = $inventory->update($data);
                return $inventory;
            } catch (ProductException $e) {
            throw $e;
        } catch (\Throwable $e) {
             return response()->json(['error' => 'An error occurred while updating inventory', $e->getMessage()], 500);
        }
    }
}
