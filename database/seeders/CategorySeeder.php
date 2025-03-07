<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objetos=[

            //Tipos de identificacion
            [
                'name'=> 'Aseo',

            ],
            [
                'name'=> 'Snacks',

            ],
            [
                'name'=> 'Bebidas',

            ],
            [
                'name'=> 'Aseo Personal',

            ],

        ];
        foreach ($objetos as $key => $objeto){
            Category::create([
                'name'=> $objeto['name'],

            ]);

        }
    }
}
