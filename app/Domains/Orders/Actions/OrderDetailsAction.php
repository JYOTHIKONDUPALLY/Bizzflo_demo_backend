<?php


namespace App\Domains\Orders\Actions;

use App\Domains\Orders\Models\orders;
use App\Domains\Orders\Models\order_items;
use App\Domains\Customer\Models\customers;
use App\Domains\Customer\Models\customer_addresses;
use App\Exceptions\UserException;
use Illuminate\Support\Facades\Auth;
use App\Domains\Payment\Models\payments;

class OrderDetailsAction
{
    public function handle($id)
{
    $User = Auth::guard('users')->user();
    if (!$User) {
        throw UserException::unauthorized();
    }


    $order = orders::findOrFail($id);
                $order_items = order_items::where('order_id', $order->order_id)->get();
                $order->order_items = $order_items;

    $customer = customers::findOrFail($order->customer_id);
    $order->customer_details = $customer;

    $order->customer_shipping_addresses = customer_addresses::where('address_id', $order->shipping_address_id)->first();
    $order->customer_billing_address = customer_addresses::where('address_id', $order->billing_address_id)->first();

    $order->payment_details = payments::where('order_id', $order->order_id)->first();

    return $order;
}

}