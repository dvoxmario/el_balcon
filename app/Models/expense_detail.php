<?php

namespace App\Models;

use App\Models\Pivots\VisitStatusOfficeVisit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit_status extends Model
{
    use HasFactory;
    protected $table =  'expense_details';

    protected $fillable =  [
        'amount',
        'expense_id',
        'product_id',
        
    ];
}