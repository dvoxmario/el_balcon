<?php

namespace Database\Seeders;

use App\Models\IdentificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objetos=[

            //Tipos de identificacion
            [
                'name'=> 'Cedula de Ciudadania',
                'value' => 'numerico',
            ],
            [
                'name'=> 'Pasaporte',
                'value' => 'alfanumerico',
            ],
        ];
        foreach ($objetos as $key => $objeto){
            IdentificationType::create([
                'name'=> $objeto['name'],
                'value' => $objeto['value'],
            ]);

        }
    }
}
