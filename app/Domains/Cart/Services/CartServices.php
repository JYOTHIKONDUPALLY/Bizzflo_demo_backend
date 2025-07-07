<?php

namespace App\Domains\Cart\Services;

use App\Interface\CartServiceInterface;
use App\Domains\Cart\Actions\GetCartAction;
use App\Domains\Cart\Actions\AddToCartAction;
use App\Domains\Cart\Actions\RemoveFromCartAction;
use App\Domains\Cart\Actions\UpdateCartAction;
use App\Domains\Cart\Actions\CheckoutFromCartAction;

class CartServices implements CartServiceInterface{

    protected GetCartAction $getCartAction;
    protected AddToCartAction $addToCartAction;
    protected UpdateCartAction $updateCartAction;
    protected RemoveFromCartAction $removeFromCartAction;
    protected CheckoutFromCartAction $checkoutFromCartAction;

    public function __construct(GetCartAction $getCartAction, AddToCartAction $addToCartAction, UpdateCartAction $updateCartAction, RemoveFromCartAction $removeFromCartAction, CheckoutFromCartAction $checkoutFromCartAction){
        $this->getCartAction = $getCartAction;
        $this->addToCartAction = $addToCartAction;
        $this->updateCartAction = $updateCartAction;
        $this->removeFromCartAction = $removeFromCartAction;
        $this->checkoutFromCartAction = $checkoutFromCartAction;
    }

    public function GetCart($data){
        return $this->getCartAction->handle($data);
    }
    public function AddToCart($data){
        return $this->addToCartAction->handle($data);
    }
    public function UpdateCart($data){
        return $this->updateCartAction->handle($data);
    }
    public function RemoveFromCart($data){
        return $this->removeFromCartAction->handle($data);
    }

    public function CheckoutFromCart($request){    
        return $this->checkoutFromCartAction->handle($request);
    }


}
?>