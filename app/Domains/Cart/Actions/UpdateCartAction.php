<?php
namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\CartItem;
use App\Domains\Orders\Models\order_items;

class UpdateCartAction
{
    public function handle($request){
       $order_items_id = $request["order_items_id"];
       $order_items = order_items::findorFail($order_items_id);
       $order_items->quantity = $request["quantity"];
       $order_items->save();
    }
}
?>