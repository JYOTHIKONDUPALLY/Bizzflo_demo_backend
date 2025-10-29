<?php

namespace App\Domains\FFL\Actions;

use App\Domains\FFL\Models\ffl_acquisition_disposition_book;
use App\Domains\Orders\Models\order_items;
use App\Domains\Products\Models\products;

class LogbookAction
{
    public function handle($request, $entry_type)
    {
        try {
            $query = ffl_acquisition_disposition_book::query();

            // Filter using the request fields if they are set
            foreach (['tenant_id', 'entry_id', 'ffl_licensee_id', 'date_of_transaction', 'city_of_party', 'state_of_party', 'order_id', 'created_by_user_id'] as $field) {
                if (!empty($request[$field])) {
                    $query->where($field, $request[$field]);
                }
            }

            // Retrieve data based on entry type
            $data = $query->where('entry_type', $entry_type)->get();
            if ($data) {
                foreach ($data as $individualData) {
                    $order_id = $individualData->order_id;
                    $order_items = order_items::where('order_id', $order_id)->get();
                    if ($order_items->isEmpty()) {
                        continue;
                    }
                    $individualData->order_items = collect($order_items)->filter(function ($item) {
                        return products::where('product_id', $item->product_id)
                            ->where('is_ffl_item', 1)
                            ->exists();
                    })->values(); // reindex if needed

                }

                return $data;
            } else {
                return "NO Data Found";
            }
        } catch (\Exception $e) {
            // Handle the exception and log it if needed
            throw new \Exception('An error occurred while processing the logbook entries', 0, $e);
        }
    }
}
