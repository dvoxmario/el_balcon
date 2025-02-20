<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission_rol extends Model
{
    protected $table =  'permission_rols';

    protected $fillable =  [
        'rol_id',
        'permission_id',
       
    ];
}
