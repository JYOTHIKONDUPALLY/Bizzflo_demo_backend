<?php
namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;
use Illuminator\Support\Facades\DB;

class AuthenticateUserRegisterAction
{
    public function handle($data)
    {
        try {
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'role_id' => $data['role_id'],
                'location_id' => $data['location_id'],
                'tenant_id' => $data['tenant_id'],
                'email' => $data['email'],
                'password_hash' => $data['password']
            ]);
            $token = $user->createToken('business-token')->plainTextToken;
            return $token ;
            
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}


?>