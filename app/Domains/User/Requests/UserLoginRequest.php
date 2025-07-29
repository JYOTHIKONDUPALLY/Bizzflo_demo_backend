<?php 

namespace App\Domains\User\Requests;

use App\Http\Requests\BaseApiRequest;

class UserLoginRequest extends BaseApiRequest
{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'email'=>'required|string|email|max:225',
            'password'=>'required|string|min:8',
            'tenant_id'=>'required|string|max:225',
            'location_id'=>'required|string|max:255'
        ];
    }
}
?>