<?php

namespace App\Domains\User\Requests;

use App\Http\Requests\BaseApiRequest;

class GetUserRequest extends BaseApiRequest
{
    public function authorize():bool{
        return true;
    }

    public function rules(): array{
        return [
            'page' => 'numeric|nullable',
            'order' => 'in:asc,desc|nullable',
            'limit' => 'numeric|nullable',
            'search'=> 'string|nullable',
            'id' => 'string|nullable',
        ];
    }
}
?>