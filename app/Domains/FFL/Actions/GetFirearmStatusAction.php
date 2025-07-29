<?php

namespace App\Domains\FFL\Actions;

use App\Domains\FFl\Models\ffl_firearms;

class GetFirearmStatusAction{
    public function handle($firearm_id){
        $firearm = Ffl_firearms::find($firearm_id);
        if(!$firearm){
            return "not found";
        }
        return $firearm->status;
    }
}