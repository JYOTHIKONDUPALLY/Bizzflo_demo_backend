<?php
namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\CartItem;

class RemoveFromCartAction{

    public function handle($request){
        $cart = $request->cart;
        $cart->delete();
    }
}
?>