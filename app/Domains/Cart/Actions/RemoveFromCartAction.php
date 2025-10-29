<?php
namespace App\Domains\Cart\Actions;

use App\Domains\Orders\Models\orders;
use App\Domains\Orders\Models\order_items;

class RemoveFromCartAction{

    public function handle($request){
        $order_item_id = $request->order_item_id;
        $order_item = order_items::findorFail($order_item_id);
        $order_item->delete();
        $orders = orders::where('order_id', $order_item->order_id)->first();
        $orders->status = 'Cancelled';
        return $orders;
    }

    
}
?>