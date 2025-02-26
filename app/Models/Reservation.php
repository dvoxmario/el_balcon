<?php

namespace App\Models;

use App\Models\Pivots\VisitStatusOfficeVisit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit_status extends Model
{
    use HasFactory;
    protected $table =  'reservations';

    protected $fillable =  [
        'reservation_start_date',
        'reservation_finish_date',
        'check_in',
        'check_out',
        'user_id',
        'responsible_id',
        'room_id',
    ];
}