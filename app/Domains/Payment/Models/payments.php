<?php

namespace App\Domains\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class payments extends Model
{
    protected $primaryKey = "payment_id";
    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = [
        'payment_id',
        'transaction_id',
        'status',
        'order_id',
        'amount',
        'payment_method',
        'payment_date',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->payment_id) {
                $model->payment_id = (string) Str::uuid();
            }
        });
    }
}
