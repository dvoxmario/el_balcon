<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IncomeDetail extends Model
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
