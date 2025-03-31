<?php

namespace App\Models;

use App\Models\Pivots\VisitStatusOfficeVisit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRol extends Model
{
    use HasFactory;
    protected $table =  'user_rols';

    protected $fillable =  [
        'user_id',
        'rol_id',
    
    ];

    function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function rols() {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}