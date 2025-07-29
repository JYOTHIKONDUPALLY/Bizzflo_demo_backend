<?php

namespace App\Domains\Dashboard\Request;

use App\Http\Requests\BaseApiRequest;

class DashboardDataRequest extends BaseApiRequest
{
     public function rules(): array
    {
        return [
            "start_date" => "required|date",
            "end_date" => "required|date",
        ];
    }
}  