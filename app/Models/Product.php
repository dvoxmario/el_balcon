<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $table =  'products';

    protected $fillable =  [
        'name',
        'value',
        'category_id',
        
    ];

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function stocks()
    {
        return $this->belongsTo(Stock::class);
    }

    public function incomeDetails()
    {
        return $this->hasMany(IncomeDetail::class);
    }

    public function expenseDetails()
    {
        return $this->hasMany(ExpenseDetail::class);
    }

    function categorys() {
        return $this->belongsTo(Category::class, 'category_id');
    }


}
