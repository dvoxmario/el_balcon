<?php

namespace App\Models;

use App\Models\Pivots\VisitStatusOfficeVisit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit_status extends Model
{
    use HasFactory;
    protected $table =  'payment_methods';

    protected $fillable =  [
        'name',
        'relation',
        'type',
        
    ];
}
