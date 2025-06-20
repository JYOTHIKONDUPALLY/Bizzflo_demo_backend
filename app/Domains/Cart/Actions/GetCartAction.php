<?php
namespace App\Domains\Cart\Actions;

use App\Domains\Cart\Models\cart_items;

class GetCartAction {

    public function handle($request){
       try{
        $query = cart_items::query();

       }catch(\Exception $e){
       }
    }
}
?>