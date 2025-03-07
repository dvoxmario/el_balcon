<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'number' => '10',
                'room_category_id' => '1',
                'amount_occupants' => '1',
                'descripction_extra' => '1',
    
                
            ],
            [
                'number' => '11',
                'room_category_id' => '4',
                'amount_occupants' => '2',
                'descripction_extra' => '2',
               
            ],
            
           
        ];
        foreach ($objetos as $key => $objeto){
            Room::create([
                'number'=> $objeto['number'],
                'room_category_id' => $objeto['room_category_id'],
                'amount_occupants' => $objeto['amount_occupants'],
                'descripction_extra' => $objeto['descripction_extra'],
                
            ]);

        }
    }
}
