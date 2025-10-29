<?php

namespace App\Domains\Orders\Actions;

use App\Domains\Orders\Models\orders;
use App\Domains\Orders\Models\order_items;
use App\Domains\Customer\Models\customers;
use App\Domains\Customer\Models\customer_addresses;
<<<<<<< HEAD
=======
use App\Exceptions\UserException;
use Illuminate\Support\Facades\Auth;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a

class OrderSummaryAction
{
    public function handle(  $id)
    {
<<<<<<< HEAD
    //   $orderId = $request->order_id;
=======
            $User = Auth::guard('users')->user();
        if (!$User) {
            throw UserException::unauthorized();
        }
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
      $result=[];
      $order = orders::findorFail($id);
                $order_items = order_items::where('order_id', $order->order_id)->get();
                $result['order_items'] = $order_items;
        $customer = customers::findorFail($order->customer_id);
        $result['customer_details'] = $customer;
        $customer_shipping_addresses = customer_addresses::where('address_id', $order->shipping_address_id)->get();
        $customer_billing_address = customer_addresses::where('address_id', $order->billing_address_id)->get();
        $result['customer_shipping_addresses'] = $customer_shipping_addresses;
        $result['customer_billing_address'] = $customer_billing_address;

        // add payment details
    return $result;
    }
}