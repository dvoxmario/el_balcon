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
}
