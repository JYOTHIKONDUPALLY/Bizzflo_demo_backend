<?php

namespace App\Domains\FFL\Actions;

use App\Domains\FFL\Models\ffl_form_4473_firearms;
use App\Domains\FFL\Models\ffl_form_4473_records;
use App\Domains\FFL\Models\ffl_licensees;
use App\Domains\FFL\Models\ffl_firearms;
use App\Domains\Products\Models\products;
use App\Domains\Orders\Models\order_items;

class FormsAction
{
    public function handle($request)
    {
        try {
            $query = ffl_form_4473_records::query();

            foreach (['form_4473_id', 'customer_id', 'order_id', 'created_by_user_id', 'nicks_response', 'is_multiple_firearm_sale'] as $field) {
                if (!empty($request[$field])) {
                    $query->where($field, $request[$field]);
                }
            }

            $records = $query->get();

            foreach ($records as $record) {
                $form_firearms = ffl_form_4473_firearms::where('form_4473_id', $record->form_4473_id)->get();

                if ($form_firearms->isEmpty()) {
                    continue;
                }

                $recordFirearms = [];

                foreach ($form_firearms as $form_firearm) {
                    // Optional filters on form_firearm
                    if (!empty($request['nicks_response']) && $form_firearm->nicks_response !== $request['nicks_response']) {
                        continue;
                    }

                    if (!empty($request['is_multiple_firearm_sale']) && $form_firearm->is_multiple_firearm_sale != $request['is_multiple_firearm_sale']) {
                        continue;
                    }

                    // Fetch firearm
                    $firearm = ffl_firearms::find($form_firearm->firearm_id);
                    if (!$firearm) {
                        continue;
                    }

                    // Apply filters on firearm
                    if (!empty($request['firearm_type']) && $firearm->firearm_type !== $request['firearm_type']) {
                        continue;
                    }

                    if (!empty($request['serial_number']) && $firearm->serial_number !== $request['serial_number']) {
                        continue;
                    }

                    // Fetch and attach licensee
                    $licensee = ffl_licensees::find($firearm->ffl_licensee_id);
                    if (!$licensee) {
                        continue;
                    }

                    $firearm->ffl_licensees = $licensee;
                    $recordFirearms[] = $firearm;
                }

                $record->firearms = $recordFirearms;

                // Process Order Items
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

            return $records;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
