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
        'name',
        'rol_id',
    
    ];
}