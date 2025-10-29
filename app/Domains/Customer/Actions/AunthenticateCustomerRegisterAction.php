<?php

namespace App\Domains\Customer\Actions;
use App\Domains\Customer\Models\Customers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AunthenticateCustomerRegisterAction
{
    public function handle($data){
        try {
            DB::beginTransaction();
            $customer = Customers::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'tenant_id' => $data['tenant_id'],
                'phone' => $data['phone']
            ]);
            DB::commit();
            $token = $customer->createToken('customer-token')->plainTextToken;

            return  $token;
        } catch (\Exception $e) {
            DB::rollBack();
         throw new \Exception($e->getMessage());
        }
    }
}
?>