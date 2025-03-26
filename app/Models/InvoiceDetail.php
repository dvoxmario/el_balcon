<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table =  'invoice_details';

    protected $fillable =  [
        'name',
        'value',
        'invoice_id',
        'product_id'
    ];

    function invoices() {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    function products() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}