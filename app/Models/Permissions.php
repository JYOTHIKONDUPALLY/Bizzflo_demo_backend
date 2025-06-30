<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;
class Permissions extends Model
{
public function role()
{
    return $this->belongsToMany(Roles::class, 'role_permissions');
}

}
