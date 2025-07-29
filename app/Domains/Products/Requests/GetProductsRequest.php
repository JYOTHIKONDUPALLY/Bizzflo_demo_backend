<?php
namespace App\Domains\Products\Requests;

use App\Http\Requests\BaseApiRequest;

class GetProductsRequest extends BaseApiRequest
{
 public function authorize(): bool{
    return true ; //add logic
 }

 public function rules() :array 
 {
    return [
        'page' => 'numeric|nullable',
        'order' => 'in:asc,desc',
        'limit' => 'numeric|nullable',
        'search'=> 'string|nullable',
        'id' => 'string|nullable',
        
    ];
 }
}
?>