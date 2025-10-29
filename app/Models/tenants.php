<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\User\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class tenants extends Model
{
    // use SoftDeletes;
    protected $primaryKey ='tenant_id';
    protected $keyType = 'string';
    public $increamenting = false;
    // protected $dates =['deleted_at'];

    protected $fillable = [
        'name', 
        'email', 
        'subdomain',
        'address',
        'status'
    ];


   public function users()
{
    return $this->hasMany(User::class);
}
 protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->tenant_id) {
                $model->tenant_id = (string) Str::uuid();
            }
        });
    }
}
