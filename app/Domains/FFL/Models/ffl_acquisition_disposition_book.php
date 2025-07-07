<?php

namespace App\Domains\FFL\Models;

use App\Models\tenants;
use App\Domains\FFL\Models\ffl_firearms;
use App\Domains\FFL\Models\ffl_licensees;
use App\Domains\Products\Models\products;
use Illuminate\Database\Eloquent\Model;
use App\Domains\User\Models\User;
use App\Domains\Orders\Models\order_items;
use Illuminate\Support\Str; 

class ffl_acquisition_disposition_book extends Model
{
    protected $primaryKey ='entry_id';
    protected $keyType ='string';
    protected $table = 'ffl_acquisition_disposition_book';
    public $incrementing=false;
    protected $fillable = [
        'tenant_id',
        'ffl_licensee_id',
        'firearm_id',
        'entry_type',
        'date_of_transaction',
        'from_whom_acquired_or_to_whom_disposed',
        'address_of_party',
        'city_of_party',
        'state_of_party',
        'type_of_identification',
        'id_number',
        'state_of_id',
        'order_id',
        'notes','created_by_user_id',
        'audit_trail_json',
    ];

    public function tenant(){
        return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
    }

    public function ffl_licensee(){
        return $this->belongsTo(ffl_licensees::class, 'ffl_licensee_id', 'ffl_licensee_id');
    }
    public function firearm(){
        return $this->belongsTo(ffl_firearms::class, 'firearm_id', 'firearm_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by_user_id', 'user_id');
    }

    // In FflAcquisitionDispositionBook.php
public function order_items()
{
    return $this->hasMany(order_items::class, 'order_item_id', 'order_item_id');
}

    public function product()
{
    return $this->belongsTo(products::class, 'product_id', 'product_id');
}
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->entry_id) {
                $model->entry_id = (string) Str::uuid();
            }
        });
    }
}
