<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\payments;
use App\Domains\Orders\Models\orders;

class RefundPaymentAction
{
    public function handle($payment)
    {
        try{
            $paymentDetails = payments::where("payment_id", $payment->id)->first();
            $amount = $paymentDetails->amount;
            $order_id = $paymentDetails->order_id;
            $order = orders::find($order_id);
            $shippingCharges = $order->shipping_cost;
            $RefundAmount = $amount - $shippingCharges;
            $paymentDetails->status = "Refunded";
            $paymentDetails->save();
            return [
                "amount" => $RefundAmount
            ];

        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
