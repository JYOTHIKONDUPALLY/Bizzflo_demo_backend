<?php

namespace App\Domains\FFL\Actions;

use App\Domains\FFl\Models\ffl_acquisition_disposition_book;

class AddAcquisitionAction
{
    public function handle ($request){
        try{

         $created = ffl_acquisition_disposition_book::create([
                    'tenant_id' => $request['tenant_id'],
                    'ffl_license_id' => $request['ffl_license_id'],
                    'firearm_id' => $request['firearm_id'],
                    'entry_type' => 'Acquisition',
                    'date_of_transaction' => $request['date_of_transaction'],
                    'from_whom_acquired_or_to_whom_disposed'=> $request['from_whom_acquired_or_to_whom_disposed'],
                    'address_of_party'=> $request['address_of_party']?? null,
                    'city_of_party'=> $request['city_of_party']?? null,
                    'state_of_party'=> $request['state_of_party']?? null,
                    'type_of_identification'=> $request['type_of_identification']?? null,
                    'id_number'=> $request['id_number']?? null,
                    'state_of_id'=> $request['state_of_id']?? null,
                    'order_id'=> $request['order_id']?? null,
                    'notes'=> $request['notes']?? null,
                    'created_by_user' => $request['created_by_user'],
                ]);
                return $created;
            }catch (\Exception $e){
                return back()->with('error', $e->getMessage());
            }
    }
}