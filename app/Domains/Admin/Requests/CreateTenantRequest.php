<?php

 namespace App\Domains\Admin\Requests;

 use App\Http\Requests\BaseApiRequest;

 class CreateTenantRequest extends BaseApiRequest
 {
     public function authorize(): bool
     {
         return true;
     }
     public function rules(): array
     {
         return [
             'name' => 'required|string',
             'subdomain' => 'required|string',
             'email' => 'required|string|email',
             'address' => 'required|string',
             'status'=> 'string'
         ];
     }
 }