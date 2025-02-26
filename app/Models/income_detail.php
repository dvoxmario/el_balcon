<?php

namespace App\Models;

use App\Models\Pivots\VisitStatusOfficeVisit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit_status extends Model
{
    use HasFactory;
    protected $table =  'income_details';

    protected $fillable =  [
        'amount',
        'price',
        'income_id',
        'product_id'
    ];
}
