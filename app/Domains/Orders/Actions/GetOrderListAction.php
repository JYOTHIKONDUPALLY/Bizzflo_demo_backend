<?php

namespace App\Domains\Orders\Actions;

use App\Domains\Orders\Models\orders;
use App\Domains\Orders\Models\order_items;
<<<<<<< HEAD
=======
use App\Domains\Products\Models\products;
use App\Domains\Products\Models\product_variants;
use App\Domains\user\Models\User;
use App\Exceptions\UserException;
use Illuminate\Support\Facades\Auth;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a

class GetOrderListAction
{
    public function handle( $request)
    {
        try {
<<<<<<< HEAD
            $customer = auth('customer')->user();
            $user = auth('users')->user();

            $customerId = $customer->customer_id ?? $user->customer_id ?? null;
            $tenant_id = $customer->tenant_id ?? $user->tenant_id ?? null;
            $location_id = $customer->location_id ?? $user->location_id ?? null;

            $query = orders::query();

            if (isset($customerId)) {
                $query->where('customer_id', $customerId);
            }

            if (isset($request['order_id'])) {
                $query->where("order_id", $request['order_id']);
            }
            if (isset($request['status'])) {
                $query->where("status", $request['status']);
            }
            if ($location_id) {
                $query->where("location_id", '249b14c8-45d8-11f0-9bbd-1098191dd2de');
            }
            if ($tenant_id) {
                $query->where("tenant_id", '249a5291-45d8-11f0-9bbd-1098191dd2de');
=======
              $User = Auth::guard('users')->user();
        if (!$User) {
            throw UserException::unauthorized();
        }
            $tenant_id =  $User->tenant_id ;
            $location_id = $User->location_id;

            $query = orders::query()->where('tenant_id', $tenant_id)->where('location_id', $location_id);

            if (isset($request['order_status'])) {
                $query->where("status", $request['order_status']);
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
            }
            if (isset($request['order_type'])) {
                $query->where("order_type", $request['order_type']);
            }
<<<<<<< HEAD
            if (isset($request['shipping_address_id'])) {
                $query->where("shipping_address_id", $request['shipping_address_id']);
            }
            if (isset($request['billing_address_id'])) {
                $query->where("billing_address_id", $request['billing_address_id']);
            }
            $orders = $query->get();
            foreach ($orders as $order) {
                $order_items = order_items::where('order_id', $order->order_id)->get();
                $order->order_items = $order_items;
            }
=======
            if(isset($request['payment_status'])) {
                $query->where("payment_status", $request['payment_status']);
            }
            $orders = $query->get();
            // foreach ($orders as $order) {
            //     $order_items = order_items::where('order_id', $order->order_id)->get();
            //     $order->order_items = $order_items;
            // }
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
            return $orders;
        } catch (\Exception $e) {
            // Log::error($e->getMessage());
            throw new \Exception('An error occurred while fetching orders');
        }
    }
}