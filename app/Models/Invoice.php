<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table =  'invoices';

    protected $fillable =  [
        'value',
        'reservation_id',
        'invoice_state',
        
    ];

    function reservations() {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }


    public function invoicePayments()
    {
        return $this->hasMany(InvoicePayment::class);
    }


    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    function invoiceStatus() {
        return $this->belongsTo(InvoiceStatus::class, 'invoice_state');
    }

}
