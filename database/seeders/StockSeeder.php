<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objetos=[

            //Tipos de identificacion
            [
                'amount'=> 12,
                'product_id'=> 1,

            ],
            [
                'amount'=> 5,
                'product_id'=> 2,

            ],
            [
                'amount'=> 100,
                'product_id'=> 3,

            ],
            [
                'amount'=> 6,
                'product_id'=> 4,

            ],
            [
                'amount'=> 6,
                'product_id'=> 5,

            ],
            [
                'amount'=> 6,
                'product_id'=> 6,

            ],
        ];
        foreach ($objetos as $key => $objeto){
            Stock::create([
                'amount'=> $objeto['amount'],
                'product_id'=> $objeto['product_id'],

            ]);

        }
    }
}
