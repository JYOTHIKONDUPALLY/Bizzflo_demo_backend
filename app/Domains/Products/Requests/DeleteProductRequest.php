<?php

namespace App\Domains\Products\Requests;

use App\Domains\Products\Models\products;
use App\Http\Requests\BaseApiRequest;

class DeleteProductRequest extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'product_id' => 'required|string|exists:products,product_id',
        ];
    }
}
