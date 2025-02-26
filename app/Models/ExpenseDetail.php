<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExpenseDetail extends Model
{
    use HasFactory;
    protected $table =  'expense_details';

    protected $fillable =  [
        'amount',
        'expense_id',
        'product_id',
        
    ];
}