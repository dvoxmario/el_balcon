<?php

namespace Database\Seeders;

use App\Models\RoomCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomCategorySeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'name' => 'Habitacion con baño individual ',
                'manual' => false,
                'price_id' => 1,
                'description' => 'adfjlkdjfja',
                
            ],
            [
                'name' => 'Habitacion con baño pareja',
                'manual' => false,
                'price_id' => 2,
                'description' => 'kdfkfk',
               
            ],
            [
                'name' => 'Habitacion sin baño individual',
                'manual' => true,
                'price_id' => 5,
                'description' => 'adfjkldjflk',
             
            ],
            [
                'name' => 'Precio Rato',
                'manual' => false,
                'price_id' => 3,
                'description' => 'akfjkajf',
             
            ],
            [
                'name' => 'Precio rato sin baño',
                'manual' => true,
                'price_id' => 6,
                'description' => 'jlaflkja',
             
            ],
            [
                'name' => 'Habitacion sin baño pareja',
                'manual' => true,
                'price_id' => 4,
                'description' => 'kajfkljd',
             
            ],
           
        ];
        foreach ($objetos as $key => $objeto){
            RoomCategory::create([
                'name'=> $objeto['name'],
                'manual' => $objeto['manual'],
                'price_id' => $objeto['price_id'],
                'description' => $objeto['description'],
                
            ]);

        }
    }
}
