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
<<<<<<< HEAD
        'page' => 'numeric',
        'order' => 'in:asc,desc',
        'limit' => 'numeric',
=======
        'page' => 'numeric|nullable',
        'order' => 'in:asc,desc',
        'limit' => 'numeric|nullable',
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
        'search'=> 'string|nullable',
        'id' => 'string|nullable',
        
    ];
 }
}
?>