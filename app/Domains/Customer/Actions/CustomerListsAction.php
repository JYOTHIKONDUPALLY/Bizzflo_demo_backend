<?php

namespace App\Domains\Customer\Actions;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UserException;

use App\Domains\Customer\Models\customers;
use App\Domains\Customer\Models\customer_addresses;

class CustomerListsAction
{
    public function handle()
    {
        try{
     $User = Auth::guard('users')->user();
      if (!$User) {
                throw UserException::unauthorized();
            }
            $tenant_id = $User->tenant_id;
        $customersList= customers::where('tenant_id', $tenant_id)->get();
        foreach ($customersList as $customer) {
            $customer->address = customer_addresses::where('customer_id', $customer->customer_id)->get();
        }
        return $customersList;
        }catch(UserException $e){
            throw $e;
        }catch(\Throwable $e){
            throw $e->getMessage();
        }
       
    }
}