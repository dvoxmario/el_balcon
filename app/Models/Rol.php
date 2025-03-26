<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rol extends Model
{
    use HasFactory;
    protected $table =  'rols';

    protected $fillable =  [
        'name',
      
    ];


    public function userRols()
    {
        return $this->hasMany(UserRol::class);
    }


    public function rolPermisions()
    {
        return $this->hasMany(PermissionRol::class);
    }

}