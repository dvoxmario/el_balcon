<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objetos=[

            //Tipos de identificacion
            [
                'name'=> 'Admin',
                'identifiers' => '10038077654',
                'password' => Hash::make('12345'),
                'identification_type_id' => 1,
            ],
            [
                'name'=> 'Mario Chaverra',
                'identifiers' => '1003810729',
                'password' => null,
                'identification_type_id' => 1,
            ],
            [
                'name'=> 'David Bermeo',
                'identifiers' => '1003807793',
                'password' => null,
                'identification_type_id' => 2,
            ],
            [
                'name'=> 'Mona',
                'identifiers' => '1003810777',
                'password' => null,
                'identification_type_id' => 2,
            ],
        ];
        foreach ($objetos as $key => $objeto){
            User::create([
                'name'=> $objeto['name'],
                'identifiers' => $objeto['identifiers'],
                'password' => $objeto['password'],
                'identification_type_id' => $objeto['identification_type_id'],
            ]);

        }
    }
}
