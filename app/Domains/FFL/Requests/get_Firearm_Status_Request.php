<?php

namespace App\Domains\FFL\Requests;

use App\Http\Requests\BaseApiRequest;


class get_Firearm_Status_Request extends BaseApiRequest
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
            "fireard_id"=> "required|string|exists:ffl_firearms,firearm_id"
            ];

    }
}