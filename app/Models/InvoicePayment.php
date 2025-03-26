<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class InvoicePayment extends Model
{
    use HasFactory;
    protected $table =  'invoice_payments';

    protected $fillable =  [
        'name',
        'relation',
        'type',
        
    ];

    function paymentMethods() {
        return $this->belongsTo(PaymentMethod::class, 'paymentMethod_id');
    }

    function invoices() {
        return $this->belongsTo(Invoice::class, 'invoicePayment_id');
    }
}
