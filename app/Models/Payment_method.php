<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    
    protected $table =  'visit_statuses';

    protected $fillable =  [
        'name',
      
    ];    
};
