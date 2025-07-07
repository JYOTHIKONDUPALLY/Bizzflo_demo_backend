<?php

namespace App\Domains\Admin\Actions;

use App\Models\Locations;
use App\Models\tenants;
use Exception;
use Illuminate\Auth\AuthenticationException;

class GetTenantsWithLocationAction
{

    public function handle($request)
    {
        try {
            $admin = $request->user('admin');
            // dd($admin);
           if(!$admin){
           throw new AuthenticationException("UnAuthorized Access");
           }
            $locations = Locations::with('tenant')
            ->get()
                ->map(function ($location) {
                    return [
                        'location_name' => $location->name,
                        'tenant_name' => optional($location->tenant)->name,
                        'status' => optional($location->tenant)->status,
                        'subdomain' => optional($location->tenant)->subdomain,
                        'email' => optional($location->tenant)->email,
                        'is_ecommerce_enabled' => $location->is_ecommerce_enabled,
                        'is_pos_enabled' => $location->is_pos_enabled,
                        'phone' => $location->phone,
                        'location_table_email' => $location->email,
                        'address' => $location->address,
                    ];
                });

            return $locations;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
