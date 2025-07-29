<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\payments;

class PaymentStatusAction
{
    public function handle($payment)
    {
        try{
          payments::where("payment_id", $payment->id)->get()->first();
            return $payment->status;
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
