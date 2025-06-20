<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\CartServiceInterface;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    protected CartServiceInterface $cartService;
    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function GetCart()
    {
        $customerId = auth('customer')->user()->id;
        $cart = $this->cartService->GetCart($customerId);
        return CartResource::collection($cart);

    }
    public function AddToCart($request) {
        $customerId = auth('customer')->user()->id;
        $cart = $this->cartService->AddToCart($customerId,$request);
        return CartResource::collection($cart);
    }

    public function RemoveFromCart($request) {
        $customerId = auth('customer')->user()->id;
        $cart = $this->cartService->RemoveFromCart($customerId,$request);
        return CartResource::collection($cart);
    }
    public function UpdateCart($request) {
        $customerId = auth('customer')->user()->id;
        $cart = $this->cartService->UpdateCart($customerId,$request);
        return CartResource::collection($cart);
    }

}
?>