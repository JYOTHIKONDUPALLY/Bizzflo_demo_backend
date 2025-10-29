<?php

namespace App\Domains\Admin\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class admin extends Authenticatable
{
    protected $table = 'admin';
    use HasApiTokens, Notifiable;

    protected $fillable = [
        "name",
        "email",
        "password",
        "role_id",
    ];

    protected $hidden = [   
        "password",
        "remember_token"
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
    ];
}
