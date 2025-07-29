<?php

namespace App\Domains\Payment\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PaymentHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_id' => 'sometimes|string|exists:payments,payment_id',
            'order_id' => 'sometimes|string|exists:orders,order_id',
            'payment_method' => 'sometimes|string|exists:payment_methods,payment_method_id',
            'transaction_id' => 'sometimes|string',
            'status' => 'sometimes|string',
            'payment_date' => 'sometimes|date',
        ];
    }
}