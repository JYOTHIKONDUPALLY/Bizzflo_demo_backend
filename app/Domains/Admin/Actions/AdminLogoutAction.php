<?php

namespace App\Domains\Admin\Actions;
use App\Domains\Admin\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class AdminLogoutAction
{
    public function handle(Request $request){
        try{
           $admin = $request->user('admin');
             if($admin){
                $admin->currentAccessToken()->delete();
                return "Logout successfully";
             } else {
                throw new AuthenticationException("UnAuthorized Access");
             }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}

?>