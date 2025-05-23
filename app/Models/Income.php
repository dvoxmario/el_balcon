<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Income extends Model
{
    use HasFactory;
    protected $table =  'incomes';

    protected $fillable =  [
        'support',
        'total_price',
        'supplier_id',
        'stock_id',
        'responsible_id',
    ];

    function stocks() {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    
    public function incomeDetails()
    {
        return $this->hasMany(IncomeDetail::class);
    }
}
