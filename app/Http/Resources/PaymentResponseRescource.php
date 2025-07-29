<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResponseRescource extends JsonResource
{
    public function toArray($request){
        return [
            'payment_id' => $this->payment_id,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'payment_type'=> $this->payment_type,
        ];
    }
}