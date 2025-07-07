<?php

namespace App\Domains\FFL\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ffl_form_4473_firearms extends Model
{
     protected $table = "ffl_form_4473_firearms";
    protected $primaryKey='form_4473_id';
     protected $keyType ='string';
     public $incrementing=false;

     protected $fillable=['firearm_id','disposition_entry_id'];

    
 
}
