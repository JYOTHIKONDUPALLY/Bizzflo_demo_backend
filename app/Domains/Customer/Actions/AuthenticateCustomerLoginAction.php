<?php

namespace App\Domains\Customer\Actions;
use App\Domains\Customer\Models\Customers;
use Illuminator\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateCustomerLoginAction
{
    public function handle($data){
         try {
            $customer = Customers::where('email', $data['email'])->first();
            if (!$customer) {
                return [
                    'error' => 'false',
                    'status' => 401,
                    'message' => 'UnAuthorized Access, Invalid Customer Id',
                ];
            }
            if (!Hash::check($data['password'], $customer['password'])) {
                return [
                    'error' => 'false',
                    'status' => 401,
                    'message' => 'UnAuthorized Access, InValid password',
                ];
            }
            $token = $customer->createToken('customer-token
            ')->plainTextToken;
            return [
                'error' => 'false',
                'status' => 200,
                'message' => 'LoggedIn successfully',
                'data' => [
                    'token' => $token
                ]
            ];
        } catch (\Exception $e) {
         throw new \Exception($e->getMessage());
        }
    }
    
}
?>
