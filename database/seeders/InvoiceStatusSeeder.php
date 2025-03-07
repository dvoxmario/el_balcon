<?php

namespace Database\Seeders;

use App\Models\InvoicePayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceStatusSeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'name' => 'cash',
                'relation' => 'Bancolombia',
                'type' => 'credit',
                
    
                
            ],
            [
                'name' => 'credit',
                'relation' => 'daviplata',
                'type' => 'savings',
                
               
            ],
            
           
        ];
        foreach ($objetos as $key => $objeto){
            InvoicePayment::create([
                'name'=> $objeto['name'],
                'relation' => $objeto['relation'],
                'type' => $objeto['type'],
                
                
            ]);

        }
    }
}
