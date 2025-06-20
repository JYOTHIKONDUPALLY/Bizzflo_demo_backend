<?php

namespace App\Domains\User\Services;

use App\Interface\UserServiceInterface;
use App\Domains\User\Actions\AuthenticateUserLoginAction;
use App\Domains\User\Actions\AuthenticateUserLogoutAction;
use App\Domains\User\Actions\AuthenticateUserRegisterAction;
use Illuminate\Auth\Middleware\Authenticate;

class UserService implements UserServiceInterface
{

    protected AuthenticateUserLoginAction $authenticateUserLoginAction;
    protected AuthenticateUserRegisterAction $authenticateUserRegisterAction;
    protected AuthenticateUserLogoutAction $authenticateUserLogoutAction;

    public function __construct(AuthenticateUserRegisterAction $authenticateUserRegisterAction, AuthenticateUserLoginAction $AuthenticateUserLoginAction , AuthenticateUserLogoutAction $authenticateUserLogoutAction )
    {
        $this->authenticateUserRegisterAction = $authenticateUserRegisterAction;
        $this->authenticateUserLoginAction = $AuthenticateUserLoginAction;
        $this->authenticateUserLogoutAction = $authenticateUserLogoutAction;
    }
    public  function registerBusinessUser($data)
    {
        return $this->authenticateUserRegisterAction->handle($data);
    }
    public  function loginBusinessUser($data)
    {
        return $this->authenticateUserLoginAction->handle($data);
    }
    public function logoutBusinessUser($request)
    {
        return $this->authenticateUserLogoutAction->handle($request);
    }
    public function getAllBusinessUsers($request){ 
        return  $this->getAllBusinessUsers($request);
    }
}

?>