<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class inventory extends Model
{
    protected $primaryKey ='inventory_id';
    protected $keyType = 'string';
    public $incrementing = false; 
    protected $table = 'inventory';

    protected $fillable = [
        'inventory_id',
        'product_id',
        'product_variant_id',
        'tenant_id',
        'location_id',
        'quantity',
        'reorder_point',
        'last_restock_date'
    ];
      protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->inventory_id) {
                $model->inventory_id = (string) Str::uuid();
            }
        });
        
    }
}
