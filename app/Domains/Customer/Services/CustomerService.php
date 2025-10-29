<?php

namespace App\Domains\Customer\Services;

use App\Interface\CustomerServiceInterface;
use App\Domains\Customer\Actions\AuthenticateCustomerLoginAction;
use App\Domains\Customer\Actions\AunthenticateCustomerRegisterAction; 
use App\Domains\Customer\Actions\AuthenticateCustomerLogoutAction;
<<<<<<< HEAD
=======
use App\Domains\Customer\Actions\CustomerListsAction;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a


class CustomerService implements CustomerServiceInterface
{
    protected AuthenticateCustomerLoginAction $authenticateCustomerLoginAction;
    protected AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction; 
    protected AuthenticateCustomerLogoutAction $authenticateCustomerLogoutAction;
<<<<<<< HEAD

    public function __construct(AuthenticateCustomerLoginAction $authenticateCustomerLoginAction, AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction ,AuthenticateCustomerLogoutAction $authenticateCustomerLogoutAction ){
        $this->authenticateCustomerLoginAction = $authenticateCustomerLoginAction;
        $this->authenticateCustomerRegisterAction = $authenticateCustomerRegisterAction;
        $this->authenticateCustomerLogoutAction = $authenticateCustomerLogoutAction;
=======
    protected CustomerListsAction $CustomerListsAction;

    public function __construct(AuthenticateCustomerLoginAction $authenticateCustomerLoginAction, AunthenticateCustomerRegisterAction $authenticateCustomerRegisterAction ,AuthenticateCustomerLogoutAction $authenticateCustomerLogoutAction, CustomerListsAction $CustomerListsAction){
        $this->authenticateCustomerLoginAction = $authenticateCustomerLoginAction;
        $this->authenticateCustomerRegisterAction = $authenticateCustomerRegisterAction;
        $this->authenticateCustomerLogoutAction = $authenticateCustomerLogoutAction;
        $this->CustomerListsAction = $CustomerListsAction;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
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
<<<<<<< HEAD
=======

    public function CustomerLists(){    
        return $this->CustomerListsAction->handle();
    }
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
}
?>