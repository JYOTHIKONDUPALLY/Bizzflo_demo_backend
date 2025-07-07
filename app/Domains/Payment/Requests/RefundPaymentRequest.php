<?php

namespace App\Domains\Payment\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundPaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "order_id" => "required|exists:orders,order_id",
            "amount" => "required|numeric|min:0",
            "reason" => "string",
        ];
    }
}
