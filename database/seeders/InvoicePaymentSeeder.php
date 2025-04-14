<?php

namespace Database\Seeders;

use App\Models\InvoicePayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoicePaymentSeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'invoice_id' => '1',
                'paymentMethod_id' => '1',
                'value_id' => 20000,
                
    
                
            ],
        
        ];    

        foreach ($objetos as $key => $objeto){
            InvoicePayment::create([
                'invoice_id'=> $objeto['invoice_id'],
                'paymentMethod_id' => $objeto['paymentMethod_id'],
                'value_id' => $objeto['value_id'],
                

            ]);
            
        }    
                
    }
}
