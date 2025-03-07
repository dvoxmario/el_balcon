<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objetos=[

            //Tipos de identificacion
            [
                'name'=> 'Cocacola Personal',
                'value'=> 3500,
                'category_id'=> 3,

            ],
            [
                'name'=> 'Detergente Liquido 2L',
                'value'=> 18000,
                'category_id'=> 1,

            ],
            [
                'name'=> 'Preservativos',
                'value'=> 1000,
                'category_id'=> 4,

            ],
            [
                'name'=> 'Detodito Picante',
                'value'=> 5000,
                'category_id'=> 2,

            ],
            [
                'name'=> 'Detodito Mix',
                'value'=> 5000,
                'category_id'=> 2,

            ],
            [
                'name'=> 'Detodito Natural',
                'value'=> 5000,
                'category_id'=> 2,

            ],

        ];
        foreach ($objetos as $key => $objeto){
            Product::create([
                'name'=> $objeto['name'],
                'value'=> $objeto['value'],
                'category_id'=> $objeto['category_id'],

            ]);

        }
    }
}
