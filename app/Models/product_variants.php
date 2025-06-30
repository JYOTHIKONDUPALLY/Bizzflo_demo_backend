<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class product_variants extends Model
{
    protected $primaryKey ='variant_id';
    protected $table = 'product_variants';  
    protected $keyType = 'string'; 
     public $incrementing = false; 
      protected $fillable = [
        'variant_id',
        'product_id',
        'name',
        'sku_suffix',
        'additional_price',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->varinat_id) {
                $model->variant_id = (string) Str::uuid();
            }
        });
    }
}
