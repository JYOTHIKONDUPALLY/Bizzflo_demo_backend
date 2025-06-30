<?php

 namespace App\Domains\Admin\Requests;

 use App\Http\Requests\BaseApiRequest;

 class GetTenantsRequest extends BaseApiRequest
 {
     public function authorize(): bool
     {
         return true;
     }
     public function rules(): array
     {
          return [
        'page' => 'numeric',
        'limit' => 'numeric',
        'search'=> 'string|nullable',        
    ];
     }
 }