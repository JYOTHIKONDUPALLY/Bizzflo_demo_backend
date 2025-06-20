<?php

namespace App\Domains\Cart\Services;

use App\Interface\CartServiceInterface;
use App\Domains\Cart\Actions\GetCartAction;
use APp\Domains\Cart\Actions\AddToCartAction;
use App\Domains\Cart\Actions\RemoveFromCartAction;
use App\Domains\Cart\Actions\UpdateCartAction;

class CartServices implements CartServiceInterface{

    protected GetCartAction $getCartAction;
    protected AddToCartAction $addToCartAction;
    protected UpdateCartAction $updateCartAction;
    protected RemoveFromCartAction $removeFromCartAction;

    public function __construct(GetCartAction $getCartAction, AddToCartAction $addToCartAction, UpdateCartAction $updateCartAction, RemoveFromCartAction $removeFromCartAction){
        $this->getCartAction = $getCartAction;
        $this->addToCartAction = $addToCartAction;
        $this->updateCartAction = $updateCartAction;
        $this->removeFromCartAction = $removeFromCartAction;
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


}
?>