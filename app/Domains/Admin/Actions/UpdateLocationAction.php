<?php

namespace App\Domains\Admin\Actions;
use App\Models\tenants;
use App\Models\Locations;
use Exception;
use App\Exceptions\TenantException;
use App\Exceptions\LocationException;
use Illuminate\Support\Facades\Auth; 

use Illuminate\Auth\AuthenticationException;

class UpdateLocationAction
{
    public function handle( $request, $location_id)
    {
        try {
                    $admin = Auth::guard('admin')->user();
            if(!$admin){
                throw new AuthenticationException("UnAuthorized Access");
            }
            $location = Locations::findOrFail($location_id);
            $tenant = tenants::find($location->tenant_id);
            if(!$tenant){
                throw TenantException::notFound("Tenant not found");
            }

            $location->update($request);
            return $location;
        } catch (AuthenticationException $e) {
         throw $e;
      }catch(TenantException $e){
        throw $e;
      } catch (LocationException $e) {
         throw $e;
      } catch (\Throwable $e) {
         throw LocationException::creationFailed($e->getMessage());
      }
    }
}