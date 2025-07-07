<?php

namespace App\Domains\FFL\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Products\Models\products;
use Illuminate\Support\Str;

class ffl_firearms extends Model
{
    protected $table = "ffl_firearms";
      protected $primaryKey='firearm_id';
        protected $keyType ='string';
           public $incrementing=false;
    protected $fillable = [
        'tenant_id',
        'product_id',
        'serial_number',
        'manufacturer',
        'model',
        'caliber_gaguge',
        'firearm_type',
        'ffl_licensee_id',
        'status',
        'notes',        
    ];

    public function product()
{
    return $this->belongsTo(Products::class, 'product_id', 'product_id');
}
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->firearm_id) {
                $model->firearm_id = (string) Str::uuid();
            }
        });
    }
}
