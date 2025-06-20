<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\User\Models\User;

class tenants extends Model
{
   public function users()
{
    return $this->hasMany(User::class);
}

}
