<?php

namespace App\Domains\Customer\Services;

use App\Interface\CustomerServiceInterface;
use App\Domains\Customer\Actions\AuthenticateCustomerLoginAction;
use App\Domains\Customer\Actions\AunthenticateCustomerRegisterAction; 
use App\Domains\Customer\Actions\AuthenticateCustomerLogoutAction;


class CustomerService implements CustomerServiceInterface
{
    protected AuthenticateCustomerLoginAction $authenticateCustomerLoginAction;
    protected AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction; 
    protected AuthenticateCustomerLogoutAction $authenticateCustomerLogoutAction;

    public function __construct(AuthenticateCustomerLoginAction $authenticateCustomerLoginAction, AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction ,AuthenticateCustomerLogoutAction $authenticateCustomerLogoutAction ){
        $this->authenticateCustomerLoginAction = $authenticateCustomerLoginAction;
        $this->authenticateCustomerRegisterAction = $authenticateCustomerRegisterAction;
        $this->authenticateCustomerLogoutAction = $authenticateCustomerLogoutAction;
    }
    public function registerCustomer($data){
        return $this->authenticateCustomerRegisterAction->handle($data);
    }

    public function loginCustomer($data){
        return $this->authenticateCustomerLoginAction->handle($data);
    }

    public function logoutCustomer($data){    
        return $this->authenticateCustomerLogoutAction->handle($data);
    }
}
?>