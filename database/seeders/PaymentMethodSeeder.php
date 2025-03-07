<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
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
            PaymentMethod::create([
                'name'=> $objeto['name'],
                'relation' => $objeto['relation'],
                'type' => $objeto['type'],
                
                
            ]);

        }
    }
}
