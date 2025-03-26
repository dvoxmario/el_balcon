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
        'number_occupants',
        'check_in',
        'check_out',
        'user_id',
        'responsible_id',
        'room_id',
    ];

    function rooms() {
        return $this->belongsTo(Room::class, 'room_id');
    }

    
    function users() {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}