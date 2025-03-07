<?php

namespace Database\Seeders;

use App\Models\InvoicePayment;
use App\Models\InvoiceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceStatusSeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'name' => 'factura abierta',
                
    
                
            ],
            [
                'name' => 'factura cancelada',
                
               
            ],
            
           
        ];
        foreach ($objetos as $key => $objeto){
            InvoiceStatus::create([
                'name'=> $objeto['name'],
                
                
                
            ]);

        }
    }
}
