<?php

 namespace App\Domains\Admin\Requests;

 use App\Http\Requests\BaseApiRequest;

 class CreateLocationRequest extends BaseApiRequest
 {
     public function authorize(): bool
     {
         return true;
     }
     public function rules(): array
     {
         return [
             'name' => 'required|string',
            //  'tenant_id' => 'required|string',
             'email' => 'required|string|email',
             'address' => 'required|string',
             'phone'=> 'string',
             'is_ecommerce_enabled'=>'boolean',
             'is_pos_enabled'=>'boolean'
         ];
     }
 }