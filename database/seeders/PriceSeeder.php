<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'name' => 'Precio noche individual ',
                'manual' => false,
                'value' => 40000,
                'person_extra' => 10000,
                
            ],
            [
                'name' => 'Precio noche pareja',
                'manual' => false,
                'value' => 55000,
                'person_extra' => 10000,
               
            ],
            [
                'name' => 'Precio Rato',
                'manual' => true,
                'value' => 20000,
                'person_extra' => 10000,
             
            ],
        ];
        foreach ($objetos as $key => $objeto){
            Price::create([
                'name'=> $objeto['name'],
                'manual' => $objeto['manual'],
                'value' => $objeto['value'],
                'person_extra' => $objeto['person_extra'],
            ]);

        }
    }
}
    

