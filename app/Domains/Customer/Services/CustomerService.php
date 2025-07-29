<?php

namespace App\Domains\Customer\Services;

use App\Interface\CustomerServiceInterface;
use App\Domains\Customer\Actions\AuthenticateCustomerLoginAction;
use App\Domains\Customer\Actions\AunthenticateCustomerRegisterAction; 
use App\Domains\Customer\Actions\AuthenticateCustomerLogoutAction;
use App\Domains\Customer\Actions\CustomerListsAction;


class CustomerService implements CustomerServiceInterface
{
    protected AuthenticateCustomerLoginAction $authenticateCustomerLoginAction;
    protected AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction; 
    protected AuthenticateCustomerLogoutAction $authenticateCustomerLogoutAction;
    protected CustomerListsAction $CustomerListsAction;

    public function __construct(AuthenticateCustomerLoginAction $authenticateCustomerLoginAction, AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction ,AuthenticateCustomerLogoutAction $authenticateCustomerLogoutAction, CustomerListsAction $CustomerListsAction){
        $this->authenticateCustomerLoginAction = $authenticateCustomerLoginAction;
        $this->authenticateCustomerRegisterAction = $authenticateCustomerRegisterAction;
        $this->authenticateCustomerLogoutAction = $authenticateCustomerLogoutAction;
        $this->CustomerListsAction = $CustomerListsAction;
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

    public function CustomerLists(){    
        return $this->CustomerListsAction->handle();
    }
}
?>