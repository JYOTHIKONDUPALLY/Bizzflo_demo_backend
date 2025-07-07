<?php

namespace App\Domains\Admin\Actions;
use App\Models\tenants;
use App\Models\Locations;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\LocationException;
use App\Exceptions\TenantException;



class CreateLocationAction {
     public function handle ($data , $tenantId, $user) {
        {
        try {
         $admin = auth('admin')->user();
           if(!$admin){
           throw new AuthenticationException("UnAuthorized Access");
           }
            $tenant = tenants::findOrFail($tenantId);
            $email_exist = tenants::where("email", $data["email"])->first();
            if(!$email_exist){
            throw LocationException::creationFailed("Email already exist");
            }
            $location = new Locations($data);
            $location->tenant_id = $tenant->tenant_id;
            $location->save();
            
            if (!$location) {
                throw LocationException::creationFailed('Database operation failed');
            }
            
            return $location;
        } catch (AuthenticationException $e) {
         throw $e;
      }catch (ModelNotFoundException $e) {
            throw TenantException::notFound();
        } catch (\Exception $e) {
            throw LocationException::creationFailed($e->getMessage());
        }
    }
}
       
     }
