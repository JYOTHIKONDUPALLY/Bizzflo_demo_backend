<?php
namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\cart_items;

class AddToCartAction{

    public function handle( $cartItem){
        $cartItem->save();
        return $cartItem;
    }
}
?>