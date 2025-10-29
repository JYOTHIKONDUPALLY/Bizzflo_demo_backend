<?php
 namespace App\Domains\Admin\Requests;

 use App\Http\Requests\BaseApiRequest;

 class AdminLoginRequest extends BaseApiRequest
 {
     public function authorize(): bool
     {
         return true;
     }
     public function rules(): array
     {
         return [
             'email' => 'required|string|email',
             'password' => 'required|string|min:8'
         ];
     }
 }