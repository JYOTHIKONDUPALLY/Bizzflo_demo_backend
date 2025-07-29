<?php

namespace App\Domains\FFL\Actions;

use App\Http\Requests\BaseApiRequest;

class AcquisitionRequest extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'ffl_licensee_id' => 'required|string|exists:ffl_licensees,ffl_licensee_id',
            'firearm_id' => 'required|string|exists:ffl_firearms,firearm_id',
            'entry_type' => 'required|string',
            'date_of_transaction'=> 'required|date',
            'from_whom_acquired_or_to_whom_disposed'=> 'required|string',
            'address_of_party'=>'required|string',
            'city_of_party'=> 'required|string',
            'state_of_party'=> 'required|string',
            'type_of_identification'=> 'nullable|string',
            'id_number'=> 'nullable|string',
            'state_of_id'=> 'nullable|string',
            'notes'=> 'string|nullable',
            'created_by_user_id'=> 'required|string|exists:users,user_id',
            'audit_trail_json'=> 'string|nullable'

        ];
    }
}