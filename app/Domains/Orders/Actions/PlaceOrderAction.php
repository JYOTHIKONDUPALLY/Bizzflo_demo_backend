<?php

namespace App\Domains\Orders\Actions;

use App\Domains\Orders\Models\Order;
use App\Domains\Orders\Models\order_items;

class PlaceOrderAction
{
    public function handle( $order)
    {
        $order->update(['status' => 'cancelled']);
        order_items::where('order_id', $order->id)->delete();
    }
}