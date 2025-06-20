<?php

namespace App\Domains\Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\tenants;
use App\Models\Categories;
use App\Models\tax_rates;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{
    use SoftDeletes;
     protected $primaryKey = 'product_id';
     protected $keyType = 'string'; 
     public $incrementing = false; 
     protected $dates = ['deleted_at'];
       
     protected $fillable = [
        'tenant_id',
        'name',
        'sku',
        'category_id',
        'brand',
        'base_price',
        'cost_price',
        'description',
        'image_url',
        'weight',
        'dimensions',
        'tax_rate_id',
        'is_ffl_item',

    ];
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->product_id) {
                $model->product_id = (string) Str::uuid();
            }
        });
    }

    public function tenant(){
        return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
    }
    public function category(){
        return $this->belongsTo(Categories::class, 'category_id', 'category_id');
    }
    public function tax(){
    return $this->belongsTo(tax_rates::class,'tax_rate_id', 'tax_rate_id');
    }
}
