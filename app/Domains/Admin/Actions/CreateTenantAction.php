<?php

namespace App\Domains\Admin\Actions;

use App\Exceptions\TenantException;
use App\Models\tenants;
use Illuminate\Auth\AuthenticationException;

class CreateTenantAction
{
   //   public function handle ($tenant) {
   //      try{
   //          $if_tenant_subdomain_exist = tenants :: where ('subdomain', $tenant['subdomain'])->first();
   //          $if_tenant_email_exist = tenants:: where ('email', $tenant['email'])->first();
   //          if ($if_tenant_subdomain_exist || $if_tenant_email_exist) {
   //             throw new \Exception('Tenant already exist');
   //          }
   //      $tenant = new tenants($tenant);
   //      $tenant->save();
   //      return $tenant;
   //      }catch (\Exception $e){
   //         throw new \Exception($e->getMessage());
   //      }

   //   }

   public function handle($tenant)
   {
      try {
         $admin = auth('admin')->user();
         if (!$admin) {
            throw new AuthenticationException("UnAuthorized Access");
         }

         $if_tenant_subdomain_exist = tenants::where('subdomain', $tenant['subdomain'])->first();
         $if_tenant_email_exist = tenants::where('email', $tenant['email'])->first();

         if ($if_tenant_subdomain_exist || $if_tenant_email_exist) {
            throw TenantException::creationFailed('Tenant already exists');
         }

         $tenant = new tenants($tenant);
         $tenant->save();
         return $tenant;
      } catch (AuthenticationException $e) {
         throw $e;
      } catch (TenantException $e) {
         throw $e;
      } catch (\Throwable $e) {
         throw TenantException::creationFailed($e->getMessage());
      }
   }
}
