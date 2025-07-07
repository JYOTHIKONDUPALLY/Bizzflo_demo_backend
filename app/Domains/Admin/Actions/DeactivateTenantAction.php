<?php
namespace App\Domains\Admin\Actions;
use App\Models\tenants;
use App\Exceptions\TenantException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class DeactivateTenantAction
{
    public function handle($tenant_id){
        try{
         $admin = Auth::guard('admin')->user();
             if(!$admin){
                throw new AuthenticationException("UnAuthorized Access");
             } else {
                $tenant = tenants::findOrFail($tenant_id);
                $tenant->status = 'Inactive';
                $tenant->save();
                return $tenant;
             }
        }catch (AuthenticationException $e) {
         throw $e;
      } catch (TenantException $e) {
         throw $e;
      } catch (\Throwable $e) {
         throw TenantException::creationFailed($e->getMessage());
      }
    }
}

?>