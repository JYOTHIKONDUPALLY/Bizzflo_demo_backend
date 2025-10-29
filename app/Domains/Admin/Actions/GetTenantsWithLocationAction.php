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
            // $admin = $request->user('admin');
            // if (!$admin) {
            //     throw new AuthenticationException("UnAuthorized Access");
            // }

            $locations = Locations::with('tenant')->get();

            // Group by tenant name
            $grouped = $locations->groupBy(function ($location) {
                return optional($location->tenant)->name ?? 'Unknown Tenant';
            });

            $result = [];

            foreach ($grouped as $tenantName => $locationGroup) {
                $first = $locationGroup->first(); // For shared tenant info
                $result[] = [
                    'tenant_id' => optional($first->tenant)->tenant_id,
                    'tenant_name' => $tenantName,
                    // 'locations' => $locationGroup->pluck('loaction_id','name')->values()->all()
                    'locations' => $locationGroup->map(function ($loc) {
                        return [
                            'id' => $loc->location_id,
                            'name' => $loc->name
                        ];
                    })->values()->all()
                ];
                // $result[] = [
                //     'tenant_name' => $tenantName,
                //     // 'status' => optional($first->tenant)->status,
                //     // 'subdomain' => optional($first->tenant)->subdomain,
                //     // 'email' => optional($first->tenant)->email,
                //     'locations' => $locationGroup->map(function ($location) {
                //         return [
                //             'location_name' => $location->name,
                //             // 'is_ecommerce_enabled' => $location->is_ecommerce_enabled,
                //             // 'is_pos_enabled' => $location->is_pos_enabled,
                //             // 'phone' => $location->phone,
                //             // 'location_table_email' => $location->email,
                //             // 'address' => $location->address,
                //         ];
                //     })->values()
                // ];
            }

            return $result;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
