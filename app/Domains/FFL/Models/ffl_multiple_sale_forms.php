<?php

namespace App\Domains\FFL\Models;

use Illuminate\Support\Str;
use App\Models\tenants;
use App\Domains\Customer\Models\customers;
use App\Domains\User\Models\User;

use Illuminate\Database\Eloquent\Model;

class ffl_multiple_sale_forms extends Model
{
    protected $table = "ffl_multiple_sale_forms";
    protected $primaryKey = 'multiple_sale_form_id';
    protected $fillable = [
        'tenant_id',
        'ffl_licensee_id',
        'customer_id',
        'order_id',
        'form_type',
        'submission_date',
        'atf_control_number',
        'status',
        'notes',
        'created_by_user_id'
    ];

      public function tenant(){
        return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
    }

    public function customer(){
        return $this->belongsTo(customers::class, 'customer_id', 'customer_id');
    }
     public function user(){
        return $this->belongsTo(User::class, 'created_by_user_id', 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->multiple_sale_form_id) {
                $model->multiple_sale_form_id = (string) Str::uuid();
            }
        });
    }
}
