<?php

namespace App\Domains\Payment\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitiatePaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "order_id" => "required|exists:orders,order_id",
            "payment_method" => "required|string|exists:payment_methods,payment_method_id",
            "amount" => "required|numeric|min:0",
        ];
    }
}
