<?php

namespace Database\Seeders;

use App\Models\UserRol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objetos=[

            //Tipos de identificacion
            [
                'user_id'=> 1, //user Admin
                'rol_id'=> 1, // rol admin 
                
            ],
            [
                'user_id'=> 2, // Mario chaverra
                'rol_id'=> 2, // cliente
                
            ],
            [
                'user_id'=> 3, // david bermeo
                'rol_id'=> 2, // CLIENTE
                
            ],        
            [
                'user_id'=> 4, //mona
                'rol_id'=> 2, // cliente
                
            ],            
        ];
        foreach ($objetos as $key => $objeto){
            UserRol::create([
                'user_id'=> $objeto['user_id'],
                'rol_id' => $objeto['rol_id'],
                
            ]);

        }
    }
}
