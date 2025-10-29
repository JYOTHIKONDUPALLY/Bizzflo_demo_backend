<?php namespace App\Interface;

interface AdminServiceInterface
{
    public function loginAdminUser( $request);
    public function logoutAdminUser( $request);
    public function createTenant( $request);
    public function tenantLocation( $request, $tenantId, $user);
    public function getTenantsWithLocations( $request);
    public function updateTenant( $request, $tenantId );
    public function deactivateTenant($tenantId );
    public function tenantLocationUpdate( $request, $locationId );
}