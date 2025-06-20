<?php
namespace App\Interface;

interface CustomerServiceInterface
{
    public function registerCustomer( $request);
    public function loginCustomer( $request);
}
?>