<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Price extends Model
{
    use HasFactory;
    protected $table =  'prices';

    protected $fillable =  [
        'name',
        'manual',
        'value',
        'person_extra'
    ];

    public function roomCategory()
    {
        return $this->hasMany(RoomCategory::class);
    }

}
