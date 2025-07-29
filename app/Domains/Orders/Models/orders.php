<?php

namespace App\Domains\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\tenants;
use App\Models\Locations;
use App\Domains\Customer\Models\customers;
use App\Domains\User\Models\User;
use App\Domains\Customer\Models\customer_addresses;
use App\Domains\Orders\Models\order_items;
use App\Domains\Products\Models\products;
use App\Models\product_variants;


class orders extends Model
{
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';
    public $incrementing = false;
    //  protected $dates = ['deleted_at'];

    protected $fillable = [
        'tenant_id',
        'location_id',
        'customer_id',
        'category_id',
        'order_date',
        'order_type',
        'status',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'shipping_cost',
        'total_amount',
        'payment_status',
        'payment_method',
        'shipping_address_id',
        'billing_address_id',
        'notes',
        'created_by_user_id'
    ];

    public function tenant()
    {
        return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
    }

    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id', 'location_id');
    }

    public function customer()
    {
        return $this->belongsTo(customers::class, 'customer_id', 'customer_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id', 'user_id')->orWhereHas('customers', function ($query) {
            $query->where('customer_id', $this->created_by_user_id);
        });
    }

   public function customer_shipping_addresses()
{
    return $this->belongsTo(customer_addresses::class, 'address_id', 'address_id');
}

public function customer_billing_address()
{
    return $this->belongsTo(customer_addresses::class, 'address_id', 'address_id');
}

    public function customer_addresses()
    {
        return $this->belongsTo(customer_addresses::class, 'address_id', 'address_id');
    }
    public function order_items()
    {
        return $this->hasMany(order_items::class);
    }
    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'product_id ');
    }

    public function variant () {
        return $this->belongsTo(product_variants::class, 'variant_id', 'variant_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->order_id) {
                $model->order_id = (string) Str::uuid();
            }
        });
    }
}
