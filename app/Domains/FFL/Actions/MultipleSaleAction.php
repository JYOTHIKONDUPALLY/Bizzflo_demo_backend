<?php

namespace App\Domains\FFL\Actions;

use App\Domains\FFL\Models\ffl_firearms;
use App\Domains\FFL\Models\ffl_multiple_sale_firearms;
use App\Domains\FFl\Models\ffl_multiple_sale_forms;
use App\Domains\FFl\Models\ffl_licensees;
use App\Domains\Products\Models\products;
use App\Domains\Orders\Models\order_items;

class MultipleSaleAction 
{
    public function handle($request)
    {
        try{
            $query = ffl_multiple_sale_forms::query();
            foreach(['multiple_sale_form_id','ffl_licensee_id', 'customer_id', 'order_id','form_type','atf_control_number','created_by_user_id' ] as $field){
               if (!empty($request[$field])) {
                    $query->where($field, $request[$field]);
                }
            }
            $records = $query->get();

            foreach($records as $record){
                $multiple_sale_form_id = $record->multiple_sale_form_id;
                $multiple_sale_firearms=ffl_multiple_sale_firearms::where('multiple_sale_form_id', $multiple_sale_form_id)->get();
                if(empty($multiple_sale_firearms)){
                    continue;
                }
                $recordMultileFirearms=[];
                foreach($multiple_sale_firearms as $multipleSaleFirearm){
                    $firearm_id = $multipleSaleFirearm->firearm_id;
                    $firearm = ffl_firearms::find($firearm_id);
                    if(empty($firearm)){
                        continue;
                    }
                    // Apply filters on firearm
                    if (!empty($request['firearm_type']) && $firearm->firearm_type !== $request['firearm_type']) {
                        continue;
                    }

                    if (!empty($request['serial_number']) && $firearm->serial_number !== $request['serial_number']) {
                        continue;
                    }
                       $licensee = ffl_licensees::find($firearm->ffl_licensee_id);
                    if (!$licensee) {
                        continue;
                    }
                    $firearm->ffl_licensees = $licensee;
                    $recordFirearms[] = $firearm;
                    $record->firearms = $recordFirearms;
                   $order_items = order_items::where('order_id', $record->order_id)->get();

                if ($order_items->isEmpty()) {
                    continue;
                }

                // Filter based on product_id if given
                if (!empty($request['product_id'])) {
                    $order_items = $order_items->where('product_id', $request['product_id']);
                }

                // Only FFL products
                $record->order_items = $order_items->filter(function ($item) {
                    return products::where('product_id', $item->product_id)
                        ->where('is_ffl_item', 1)
                        ->exists();
                })->values(); // reset index

                }

            }
            return $records;

        }catch(\Exception $e){

        }
    }
}
