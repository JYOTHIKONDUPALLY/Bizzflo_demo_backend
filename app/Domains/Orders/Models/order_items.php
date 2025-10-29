<?php

namespace App\Domains\Orders\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use APp\Domains\Products\Models\products;
=======
use App\Domains\Products\Models\products;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
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

<<<<<<< HEAD
=======
    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id', 'order_id');
    }


>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
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
