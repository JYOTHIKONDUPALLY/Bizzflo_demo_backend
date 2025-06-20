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
            'page' => 'numeric',
            'order' => 'in:asc,desc',
            'limit' => 'numeric',
            'search'=> 'string|nullable',
            'id' => 'string|nullable',
        ];
    }
}
?>