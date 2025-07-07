<?php

namespace App\Domains\FFL\Requests;

use App\Http\Requests\BaseApiRequest;

class getMultipleSaleRequest extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'multiple_sale_form_id' => 'sometimes|exists:ffl_multiple_sale_forms,multiple_sale_form_id',
           'ffl_licensee_id' =>'sometimes|exists:ffl_licensees,ffl_licensee_id',
           'customer_id' => 'sometimes|exists:customers,customer_id',
           'order_id' => 'sometimes|exists:orders,order_id',
           'form_type'=>'sometimes|number',
           'atf_control_number'=>'sometimes|string',
           'status'=>'somtimes|string',
           'created_by_user_id'=>'sometimes|exists:users,user_id',
           'product_id'=>'sometimes|exists:products,product_id',
           'firearm_type'=>'sometimes|exists:ffl_firearms,firearm_type',
           'manufacturer'=>'sometimes|exists:ffl_firearms,manufacturer',
           'serial_number'=>'sometimes|exists:ffl_firearms,serial_number',
        ];
    }
}