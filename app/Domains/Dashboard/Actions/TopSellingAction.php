<?php

namespace App\Domains\Dashboard\Actions;

use Illuminate\Support\Facades\Auth;
use App\Domains\Orders\Models\order_items;
use App\Domains\Products\Models\products;
use App\Exceptions\UserException;
use Illuminate\Support\Facades\DB;

class TopSellingAction
{
    public function handle()
    {
        try {
            $user = Auth::guard('users')->user();
            if (!$user) {
                throw  UserException::unauthorized();
            }
            $tenant_id = $user->tenant_id;
            $location_id = $user->location_id;
            $query = order_items::with(['product', 'order', 'product.category'])
                ->select(
                    'product_id',
                    DB::raw('SUM(quantity) as total_quantity'),
                    DB::raw('SUM(line_total) as total_amount')
                )
                ->whereHas('order', function ($query) use ($tenant_id, $location_id) {
                    $query->where('tenant_id', $tenant_id)
                        ->where('location_id', $location_id);
                })
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->limit(10)
                ->get();
            return $query->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'category_name' => $item->product->category->name ?? 'Uncategorized',
                    'quantity' => $item->total_quantity,
                    'total_amount' => $item->total_amount,
                ];
            });
        } catch (UserException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
