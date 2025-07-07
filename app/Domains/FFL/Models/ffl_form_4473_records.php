<?php

namespace App\Domains\FFL\Models;

use App\Models\tenants;
use App\Domains\Customer\Models\customers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class ffl_form_4473_records extends Model
{
    protected $table = "ffl_form_4473_records";
     protected $primaryKey='form_4473_id';
     protected $keyType ='string';
     public $incrementing=false;
       protected $fillable = [
        'tenant_id',
        'customer_id',
        'order_id',
        'date_completed',
        'nicks_transaction_number',
        'nicks_response',
        'nicks_response_date',
        'is_valid',
        'form_data_json',
        'is_multiple_firearm_sale',     
        'notes',
        'created_by_user_id'   
    ];
     public function tenant(){
        return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
    }

    public function customer(){
        return $this->belongsTo(customers::class, 'customer_id', 'customer_id');
    }

      protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->form_4473_id) {
                $model->form_4473_id = (string) Str::uuid();
            }
        });
    }
}
