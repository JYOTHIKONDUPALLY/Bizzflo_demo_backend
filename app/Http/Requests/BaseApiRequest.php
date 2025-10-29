<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\ApiResponseResource;

class BaseApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            (new ApiResponseResource(
                $validator->errors(),
                'Validation failed',
                422,
                true
            ))->response()->setStatusCode(422)
        );
    }
}

