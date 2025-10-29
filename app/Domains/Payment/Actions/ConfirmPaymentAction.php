<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\payments;


class ConfirmPaymentAction
{
    public function handle($payment)
    {
        try{
            $payment = payments::where('payment_id', $payment['payment_id'])->first();
            $payment->transaction_id = $payment['transaction_id'];
            $payment->status = $payment['status'];
            $payment->payment_date = now();
            $payment->save();
            return $payment;
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
