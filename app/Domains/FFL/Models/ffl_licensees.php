<?php

namespace App\Domains\FFL\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Locations;
use Illuminate\Support\Str;

class ffl_licensees extends Model
{
     protected $table = "ffl_licensees";
     protected $primaryKey='ffl_licensee_id';
     protected $keyType ='string';
     public $incrementing=false;
     protected $fillable = [
<<<<<<< HEAD
        'loaction_id',
=======
        'location_id',
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
        'tenant_id',
        'ffl_number',
        'licensee_name', 
        'expiration_date',
        'license_type', 
        'phone',
        'email',
        'address',
        'city',
        'state',
        'zip_code'
       ];

       public function locations()
    {
       return $this->belongsTo(Locations::class,'location_id','location_id');
    }
         protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->ffl_licensee_id) {
                $model->ffl_licensee_id = (string) Str::uuid();
            }
        });
    }

}
