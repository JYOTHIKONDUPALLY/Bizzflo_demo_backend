<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\payments;

class PaymentHistoryAction
{
    public function handle($payment)
    {
        try{
            $query = Payments::query();
            if($payment->payment_id){
                $query->where("payment_id", $payment->payment_id);
            }
            if($payment->order_id){
            $query->where("order_id", $payment->order_id);
            }
            if($payment->payment_method){
                $query->where("payment_method", $payment->payment_method);
            }
            if($payment->transaction_id){
                $query->where("transaction_id", $payment->transaction_id);
            }
            if($payment->status){
                $query->where("status", $payment->status);
            }
            if($payment->payment_date){
                $query->where("payment_date", $payment->payment_date);
            }
            $paymentHistory = $query->get()->toArray();
            return $paymentHistory;

        }catch(\Exception $e){
            return redirect()->back()->with("error","".$e->getMessage());
        }
    }
}
