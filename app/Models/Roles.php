<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\User\Models\User;
use App\Models\Permissions;

class Roles extends Model
{
    public function users()
{
    return $this->hasMany(User::class);
}

public function permissions()
{
    return $this->belongsToMany(Permissions::class, 'role_permissions');
}

}
