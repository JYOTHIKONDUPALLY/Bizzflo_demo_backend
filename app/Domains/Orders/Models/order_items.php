<?php

namespace App\Domains\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use APp\Domains\Products\Models\products;
use Illuminate\Support\Str;
use App\Models\product_variants;

class order_items extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $primaryKey = 'order_item_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'unit_price',
        'discount_per_item',
        'tax_per_item',
        'line_total'
    ];

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'product_id');
    }

    public function varinat()
    {
        return $this->belongsTo(product_variants::class, 'varinat_id', 'varinat_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->order_item_id) {
                $model->order_item_id = (string) Str::uuid();
            }
        });
    }
}
