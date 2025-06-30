<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;
use Illuminator\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\UserException;

class AuthenticateUserRegisterAction
{
    public function handle($data)
    {
        try {
            $user = Auth::guard('users')->user();
            if (!$user) {
                throw new AuthenticationException("UnAuthorized Access");
            }
            if ($user->role->role_name == 'Franchise Owner' || $user->role->role_name == 'Admin') {
               $CreateUser = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'role_id' => $data['role_id'],
                'location_id' => $data['location_id'],
                'tenant_id' => $data['tenant_id'],
                'email' => $data['email'],
                'password_hash' => $data['password'],
                'created_by' => $user->user_id,
            ]);
            return $CreateUser;
               
            }else {
                 throw UserException::accessDenied();
            }
           
        } catch (AuthenticationException $e) {
            throw $e;
        } catch (UserException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw UserException::creationFailed($e->getMessage());
        }
    }
}
