<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoomCategory extends Model
{
    use HasFactory;
    protected $table =  'room_categories';

    protected $fillable =  [
        'name',
        'description',
        'price_id',
        
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    function prices() {
        return $this->belongsTo(Price::class, 'price_id');
    }

    
}