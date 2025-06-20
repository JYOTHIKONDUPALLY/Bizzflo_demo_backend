<?php

namespace App\Domains\Customer\Services;

use App\Interface\CustomerServiceInterface;
use App\Domains\Customer\Actions\AuthenticateCustomerLoginAction;
use App\Domains\Customer\Actions\AunthenticateCustomerRegisterAction; 


class CustomerService implements CustomerServiceInterface
{
    protected AuthenticateCustomerLoginAction $authenticateCustomerLoginAction;
    protected AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction; 

    public function __construct(AuthenticateCustomerLoginAction $authenticateCustomerLoginAction, AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction){
        $this->authenticateCustomerLoginAction = $authenticateCustomerLoginAction;
        $this->authenticateCustomerRegisterAction = $authenticateCustomerRegisterAction;
    }
    public function registerCustomer($data){
        return $this->authenticateCustomerRegisterAction->handle($data);
    }

    public function loginCustomer($data){
        return $this->authenticateCustomerLoginAction->handle($data);
    }
}
?>