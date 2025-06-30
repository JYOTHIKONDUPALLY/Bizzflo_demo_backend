<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\AdminServiceInterface;
use App\Domains\Admin\Requests\{CreateTenantRequest, CreateLocationRequest, GetTenantsRequest, UpdateTenantRequest,UpdateLocationRequest};
use App\Exceptions\{TenantException, LocationException};
use App\Http\Resources\ApiResponseResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;


class TenantController extends Controller
{
    protected AdminServiceInterface $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    public function createTenant(CreateTenantRequest $request): ApiResponseResource
    {
        $tenant = $this->adminService->createTenant($request->validated());
        return new ApiResponseResource(
            $tenant,
            'Tenant has been created successfully',
            201
        );
    }

    public function tenantUpdate(UpdateTenantRequest $request,  $tenant_id): ApiResponseResource
    {
        $tenant = $this->adminService->updateTenant($request->validated(), $tenant_id);
        return new ApiResponseResource(
            $tenant,
            'Tenant has been updated successfully',
            200
        );
    }

    public function deactivateTenant( $tenant_id): ApiResponseResource
    {
    
        $response = $this->adminService->deactivateTenant($tenant_id);
        return new ApiResponseResource(
            $response,
            'Tenant has been deactivated successfully',
            200
        );
    }

    public function tenantLocation(CreateLocationRequest $request, $tenant_id): ApiResponseResource
    {
             $location = $this->adminService->tenantLocation($request->validated(), $tenant_id, $request->user());
        return new ApiResponseResource(
            $location,
            'Location has been created successfully',
            201
        );
 
    }

    public function tenantLocationUpdate(UpdateLocationRequest $request, $location_id): ApiResponseResource{
        $location = $this->adminService->tenantLocationUpdate($request->validated(), $location_id);
        return new ApiResponseResource(
            $location,
            'Location has been updated successfully',
            200
        );
    }

    public function getTenantsWithLocations(GetTenantsRequest $request): ApiResponseResource
    {
        $tenantsData = $this->adminService->getTenantsWithLocations($request->validated());
        return new ApiResponseResource(
            $tenantsData,
            'Tenants has been fetched successfully',
            200
        );
    }
}
