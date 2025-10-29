<?php

namespace App\Domains\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
=======
use App\Models\tenants;
use App\Domains\Customer\Models\customer_addresses;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a

class customers extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'customer_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'tenant_id',
        'email',
        'phone',
        'password'
    ];
    protected $hidden = [
        'password_hash',
    ];

    public function getFullNameAttribute()
{
    return trim($this->first_name . ' ' . $this->last_name);
}

<<<<<<< HEAD
=======
public function tenant(){
    return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
}

public function customerAddress(){
    return $this->hasMany(customer_addresses::class, 'customer_id', 'customer_id');
}

>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->customer_id) {
                $model->customer_id = (string) Str::uuid();
            }
        });
    }
}
