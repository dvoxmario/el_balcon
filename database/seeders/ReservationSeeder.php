<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'user_id' => 1,
                'responsible_id' => 1,
                'reservation_start_date' => '2025-03-07',
                'reservation_finish_date' => '2025-03-07',
                'room_id'=> 2,
                'number_occupants' => 2,
                
                
                
    
                
            ],
            [
                'user_id' => 3,
                'responsible_id' => 1,
                'reservation_start_date' => '2025-03-07',
                'reservation_finish_date' => '2025-03-07',
                'room_id'=> 1,
                'number_occupants' => 1,
               
            ],
            
           
        ];
        foreach ($objetos as $key => $objeto){
            Reservation::create([
                'user_id' => $objeto['user_id'],
                'responsible_id' => $objeto['responsible_id'],
                'number_occupants' => $objeto['number_occupants'],
                'reservation_start_date' => $objeto['reservation_start_date'],
                'reservation_finish_date' => $objeto['reservation_finish_date'],
                'room_id' => $objeto['room_id'],
                
            ]);

        }
    }
}
