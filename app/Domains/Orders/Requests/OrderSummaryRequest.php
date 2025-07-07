<?php

namespace App\Domains\Orders\Requests;

use App\Domains\Orders\Models\Order;
use App\Http\Requests\BaseApiRequest;

class OrderSummaryRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array{
        return [
            "order_id"=> "required|exists:orders,order_id",
        ];
    }
}
