<?php

namespace App\Domains\Orders\Actions;

use App\Domains\Orders\Models\orders;
use App\Domains\Orders\Models\order_items;
use App\Domains\Customer\Models\customers;
use App\Domains\Customer\Models\customer_addresses;

class OrderSummaryAction
{
    public function handle(  $id)
    {
    //   $orderId = $request->order_id;
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