<?php

namespace App\Domains\Payment\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitiatePaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_id' => 'required|string',
        ];
    }
}
