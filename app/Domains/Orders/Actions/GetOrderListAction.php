<?php

namespace App\Domains\Orders\Actions;

use App\Domains\Orders\Models\orders;
use App\Domains\Orders\Models\order_items;
use App\Domains\Products\Models\products;
use App\Domains\Products\Models\product_variants;
use App\Domains\user\Models\User;
use App\Exceptions\UserException;
use Illuminate\Support\Facades\Auth;

class GetOrderListAction
{
    public function handle( $request)
    {
        try {
              $User = Auth::guard('users')->user();
        if (!$User) {
            throw UserException::unauthorized();
        }
            $tenant_id =  $User->tenant_id ;
            $location_id = $User->location_id;

            $query = orders::query()->where('tenant_id', $tenant_id)->where('location_id', $location_id);

            if (isset($request['order_status'])) {
                $query->where("status", $request['order_status']);
            }
            if (isset($request['order_type'])) {
                $query->where("order_type", $request['order_type']);
            }
            if(isset($request['payment_status'])) {
                $query->where("payment_status", $request['payment_status']);
            }
            $orders = $query->get();
            // foreach ($orders as $order) {
            //     $order_items = order_items::where('order_id', $order->order_id)->get();
            //     $order->order_items = $order_items;
            // }
            return $orders;
        } catch (\Exception $e) {
            // Log::error($e->getMessage());
            throw new \Exception('An error occurred while fetching orders');
        }
    }
}