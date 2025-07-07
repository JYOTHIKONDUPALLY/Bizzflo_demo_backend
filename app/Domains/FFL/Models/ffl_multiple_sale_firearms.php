<?php

namespace App\Domains\FFL\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ffl_multiple_sale_firearms extends Model
{
    protected $table = "ffl_multiple_sale_firearms";
    // protected $primaryKey = "multiple_sale_form_id";
    // protected $keyType = "string";
    // public $incrementing = false;
    protected $fillable = [
         "firearm_id"];
}
