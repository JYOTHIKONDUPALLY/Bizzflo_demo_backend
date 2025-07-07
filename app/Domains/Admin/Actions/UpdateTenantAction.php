<?php

namespace App\Domains\Admin\Actions;
use App\Models\tenants;
use App\Models\Locations;
use Exception;
use Illuminate\Auth\AuthenticationException;

class UpdateTenantAction
{
    public function handle( $request, $tenant_id)
    {
        try {
            $tenant = tenants::findOrFail($tenant_id);
            $tenant->update($request);
            return $tenant;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}