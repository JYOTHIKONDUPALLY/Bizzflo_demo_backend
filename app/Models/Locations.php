<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\User\Models\User;
use App\Models\inventory;
use App\Models\tenants;
use Illuminate\Support\Str;

class Locations extends Model
{
    protected $primaryKey = 'location_id';
    protected $keyType = 'string';
    public $increamenting = false;

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'address',
        'phone',
        'is_ecommerce_enabled',
        'is_pos_enabled'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function inventory()
{
    return $this->hasMany(inventory::class, 'location_id', 'location_id');
}


    public function tenant()
    {
        return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->location_id) {
                $model->location_id = (string) Str::uuid();
            }
        });
    }
}
