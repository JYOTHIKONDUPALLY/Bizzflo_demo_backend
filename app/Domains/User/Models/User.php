<?php

namespace App\Domains\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\Roles;
use App\Models\locations;
use App\Models\Permissions;
<<<<<<< HEAD
=======
use App\Models\tenants;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;
     protected $primaryKey = 'user_id';
     protected $keyType = 'string'; 
      public $incrementing = false; 
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'location_id',
        'tenant_id',
        'email',
        'password_hash',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password_hash' => 'hashed',
        ];
    }

    public function role()
{
    return $this->belongsTo(Roles::class , 'role_id', 'role_id');
}

public function location()
{
    return $this->belongsTo(Locations::class , 'location_id', 'location_id');
}

<<<<<<< HEAD
=======
public function tenant(){
    return $this->belongsTo(tenants::class, 'tenant_id', 'tenant_id');
}

>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
public function getFullNameAttribute()
{
    return trim($this->first_name . ' ' . $this->last_name);
}



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->user_id) {
                $model->user_id = (string) Str::uuid();
            }
        });
    }
}
