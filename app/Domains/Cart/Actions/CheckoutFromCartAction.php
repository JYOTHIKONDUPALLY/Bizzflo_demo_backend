<?php

namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\CartItem;
use App\Domains\Orders\Models\order_items;
use App\Domains\Orders\Models\orders;

class CheckoutFromCartAction
{
    public function handle($request)
    {
        $customer = auth('customer')->user();
        $order = orders::where('order_id', $request['order_id'])->first();
        if ($order) {
        $order->shipping_address_id = $request['shipping_address_id'];
        $order->billing_address_id = $request['billing_address_id'];
        $order->status = 'Pending';
        $order->save();
        }
        else {
            return "Order not found";
        }
        return $order;
    }
}
