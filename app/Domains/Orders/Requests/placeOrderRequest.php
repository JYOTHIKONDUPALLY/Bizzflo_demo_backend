<?php

namespace App\Domains\Orders\Requests;

use App\Http\Requests\BaseApiRequest;
use App\Domains\Orders\Models\order_items;
use App\Domains\Orders\Models\orders;

class placeOrderRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:orders,id'
        ];
    }
}

