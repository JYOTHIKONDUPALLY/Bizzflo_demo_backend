<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\payments;

class InitiatePaymentAction
{
    public function handle($payment)
    {
        try{
            $created = payments::create([
                'order_id' => $payment['order_id'],
                'amount' => $payment['amount'],
                'payment_method' => $payment['payment_method'],
                'status' => 'Pending'
            ]);
            return $created;
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
