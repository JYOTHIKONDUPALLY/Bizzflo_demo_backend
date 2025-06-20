<?php

namespace App\Interface;
interface CartServiceInterface
{
    public function AddToCart($request);
    public function RemoveFromCart($request);
    public function GetCart($request);
    public function UpdateCart($request);
}

?>