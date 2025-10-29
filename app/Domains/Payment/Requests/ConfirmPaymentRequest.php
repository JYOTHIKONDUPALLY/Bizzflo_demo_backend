<?php

namespace App\Domains\Payment\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmPaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "payment_id" => "required|string|exists:payments,payment_id",
            "transaction_id" => "required|string",
            "status" => "required|string",
        ];
    }
}
