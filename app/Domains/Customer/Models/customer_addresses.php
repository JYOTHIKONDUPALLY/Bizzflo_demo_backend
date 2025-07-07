<?php

namespace App\Domains\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class customer_addresses extends Model
{
    use SoftDeletes;
     protected $primaryKey = 'address_id';
     protected $keyType = 'string'; 
     public $incrementing = false; 
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'customer_id',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'country',
        'address_type',
        'is_default'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->address_id) {
                $model->address_id = (string) Str::uuid();
            }
        });
    }
}
