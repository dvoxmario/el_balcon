<?php

namespace App\Models;

use App\Models\Pivots\VisitStatusOfficeVisit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class stock extends Model
{
    
    protected $table =  'stocks';

    protected $fillable =  [
        'name',
        'amount',
        'product_id',
        
    ];

}
