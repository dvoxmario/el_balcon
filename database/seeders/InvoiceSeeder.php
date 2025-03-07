<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
       $objetos=[
            [
                'reservation_id' => '10',
                'invoice_status_id' => '1',
                'value' => '20000',
                
    
                
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
