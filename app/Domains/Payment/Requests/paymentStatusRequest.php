<?php

namespace App\Domains\Payment\Requests;
use Illuminate\Foundation\Http\FormRequest;

class paymentStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_id' => 'required|string|exists:payments,payment_id',
        ];
    }
}