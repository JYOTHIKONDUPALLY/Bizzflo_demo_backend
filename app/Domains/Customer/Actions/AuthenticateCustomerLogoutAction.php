<?php

namespace App\Domains\Customer\Actions;
use App\Domains\Customer\Models\Customer;
use Illuminate\Http\Request;

class AuthenticateCustomerLogoutAction
{
    public function handle(Request $request){
        try{
             $customer = $request->user('customer');
             if($customer){
                $customer->currentAccessToken()->delete();
                return "Logout successfully";
             }
             return "UnAuthorized Access";
            

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}

?>