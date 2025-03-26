<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{

    protected $table =  'stocks';

    protected $fillable =  [
        'amount',
        'product_id',

    ];

    function products() {
        return $this->hasOne(Product::class, 'product_id');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

}
