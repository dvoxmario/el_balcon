<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Expense extends Model
{
    use HasFactory;
    protected $table =  'expenses';

    protected $fillable =  [
        'support',
        'stock_id',
        'responsible_id',
        
    ];

    function stocks() {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    function responsible() {
        return $this->belongsTo(User::class, 'responsible_id');
    }


    public function expense()
    {
        return $this->hasMany(ExpenseDetail::class);
    }
    
}
