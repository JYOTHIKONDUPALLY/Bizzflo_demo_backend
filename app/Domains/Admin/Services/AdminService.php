<?php

namespace App\Domains\Admin\Services;

use App\Interface\AdminServiceInterface;
use App\Domains\Admin\Actions\AdminLoginAction;
use App\Domains\Admin\Actions\AdminLogoutAction;
use App\Domains\Admin\Actions\CreateTenantAction;
use App\Domains\Admin\Actions\CreateLocationAction;
use App\Domains\Admin\Actions\GetTenantsWithLocationAction;
use App\Domains\Admin\Actions\UpdateTenantAction;
use App\Domains\Admin\Actions\DeactivateTenantAction;
use App\Domains\Admin\Actions\UpdateLocationAction;
use Illuminate\Auth\Middleware\Authenticate;

class AdminService implements AdminServiceInterface
{

    protected AdminLoginAction $adminLoginAction;
    protected AdminLogoutAction $adminLogoutAction;
    protected CreateTenantAction $createTenantAction;
    protected CreateLocationAction $createLocationAction;
    protected GetTenantsWithLocationAction $getTenantsWithLocationAction;
    protected UpdateTenantAction $updateTenantAction;
    protected DeactivateTenantAction $deactivateTenantAction;
    protected UpdateLocationAction $updateLocationAction;

    public function __construct(AdminLoginAction $adminLoginAction, AdminLogoutAction $adminLogoutAction, CreateTenantAction $createTenantAction, CreateLocationAction $createLocationAction, GetTenantsWithLocationAction $getTenantsWithLocationAction , UpdateTenantAction $updateTenantAction, DeactivateTenantAction $deactivateTenantAction, UpdateLocationAction $updateLocationAction)
    {
        $this->adminLoginAction = $adminLoginAction;
        $this->adminLogoutAction = $adminLogoutAction;
        $this->createTenantAction = $createTenantAction;
        $this->createLocationAction = $createLocationAction;
        $this->getTenantsWithLocationAction = $getTenantsWithLocationAction;
        $this->updateTenantAction = $updateTenantAction;
        $this->deactivateTenantAction = $deactivateTenantAction;
        $this->updateLocationAction = $updateLocationAction;
    }


    public  function loginAdminUser($data)
    {
        return $this->adminLoginAction->handle($data);
    }
    public function logoutAdminUser($request)
    {
        return $this->adminLogoutAction->handle($request);
    }
    public function createTenant($data){
        return $this->createTenantAction->handle($data);
    }
    public function tenantLocation($data, $tenantId, $user){
        return $this->createLocationAction->handle($data, $tenantId,$user);
    }
    public function getTenantsWithLocations($data){  
        return $this->getTenantsWithLocationAction->handle($data);
    }
    public function updateTenant($data, $tenant_id){  
        return $this->updateTenantAction->handle($data, $tenant_id);
    }
    public function deactivateTenant($tenant_id){  
        return $this->deactivateTenantAction->handle($tenant_id);
    }
    public function tenantLocationUpdate($request, $location_id){  
        return $this->updateLocationAction->handle($request,$location_id);
    }
}

?>