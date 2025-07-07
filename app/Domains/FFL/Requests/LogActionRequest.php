<?php

namespace App\Domains\FFL\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseApiRequest;

class LogActionRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'tenant_id'=> 'required|exists:tenants,tenant_id',
            'entry_id'=> 'somtimes|exists:ffl_acquisition_disposition_books,id',
            'ffl_licensee_id'=> 'sometimes|exists:ffl_licensees,ffl_licensee_id',
            'date_of_transaction'=> 'sometimes|string',
            'city_of_party'=>'sometimes|string',
            'state_of_party'=>'sometimes|string',
            'order_id'=>'sometimes| exist:orders,order_id',
            'created_by_user_id'=>'sometimes| exist:users,user_id',
        ];
    }
}
