<?php

namespace App\Domains\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\tenants;
use App\Domains\Products\Models\products;
use App\domains\Customer\Models\customers;

class cart_items extends Model
{
   use SoftDeletes;
   protected $keyType="string";
   public $incrementing = false;
   protected $dates=['deleted_at'];

   protected $fillable=[
    "tenant_id",
    "customer_id",
    "product_id",
    "status",
    "quantity",
    "unit_price",
    "subtotal"
   ];

   protected static function boot()
   {
       parent::boot();

       static::creating(function ($model) {
           if (!$model->id) {
               $model->id = (string) Str::uuid();
           }
       });
   }
    public function tenant(){
        return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
    }
    public function product(){
        return $this->belongsTo(products::class, 'product_id', 'product_id');
    }

    public function customer(){
        return $this->belongsTo(customers::class, 'customer_id', 'customer_id');
    }
}
