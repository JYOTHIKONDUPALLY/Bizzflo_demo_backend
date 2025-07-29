<?php

namespace App\Domains\FFL\Actions;

use App\Domains\FFL\Models\ffl_firearms;

class AddFirearmAction
{
    public function handle($request)
    { 
      try{
        $created = ffl_firearms::create([
            'tenant_id' => $request['tenant_id'],
            'product_id' => $request['product_id'],
            'serial_number' => $request['serial_number'],
            'firearm_type' => $request['firearm_type'],
            'manufacturer' => $request['manufacturer'],
            'model' => $request['model'],
            'caliber_gauge' => $request['caliber_gauge'],
            'ffl_licensee_id' => $request['ffl_licensee_id'],
            'status' => $request['status'],
            'notes' => $request['notes'],
        ]);
        return $created;

      }catch(\Exception $e){
        return response()->json([   
            'error' => true,
            'status' => 500,
            'message' => $e->getMessage(),
        ], 500);
    }
}
}