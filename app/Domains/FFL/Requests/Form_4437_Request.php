<?php

namespace App\Domains\FFL\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseApiRequest;


class Form_4437_Request extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'firearm_type' => 'sometimes|exists:ffl_firearms,firearm_type',
            'form_4473_id' => 'sometimes|exists:ffl_form_4473_records,form_4473_id',
            'customer_id' => 'sometimes | exists:customers,customer_id',
            'order_id' => 'sometimes|exists:orders,order_id',
            'product_id' => 'sometimes|exists:products,product_id',
            'created_by_user_id' => 'sometimes|exists:users,user_id',
            'serial_number' => 'sometimes|string',
            'status' => 'sometimes|string',
            'nicks_response' => 'sometimes|string',
            'is_multiple_firearm_sale' => 'sometimes|number|0,1',
        ];
    }
}
