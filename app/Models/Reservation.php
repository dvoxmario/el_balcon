<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
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