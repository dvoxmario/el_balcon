<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_rol extends Model
{
    protected $table =  'user_rols';

    protected $fillable =  [
        'user_id',
        'rol_id',

    ];
}
