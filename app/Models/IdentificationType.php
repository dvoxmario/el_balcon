<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{

    protected $table =  'identification_types';

    protected $fillable =  [
        'name',
        'value',

    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
