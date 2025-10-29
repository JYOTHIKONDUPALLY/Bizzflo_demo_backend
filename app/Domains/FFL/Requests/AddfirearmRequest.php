<?php

namespace App\Domains\FFL\Requests;

use App\Http\Requests\BaseApiRequest;

class AddfirearmRequest extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,product_id',
            'serial_number' => 'required|string',
            'manufacturer' => 'required|string',
            'model' => 'required|string',
            'firearm_type' => 'required|string',
            'caliber_gauge' => 'required|string',
            'ffl_licensee_id' => 'required|string|exists:ffl_licensees,ffl_licensee_id',
            'status' => 'required|string',
            'notes' => 'string|nullable'
        ];
    }
}
