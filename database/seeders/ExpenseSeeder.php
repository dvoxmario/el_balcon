<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\expense\Facades\Hash;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            $objetos=[
    
                //Tipos de identificacion
                [
                    'stock_id'=> '7',
                    'responsible_id' => '1',
                    'support' => 'mario',
                    
                ],
            ];
            
            foreach ($objetos as $key => $objeto){
                Expense::create([
                    'stock_id'=> $objeto['stock_id'],
                    'responsible_id'=> $objeto['responsible_id'],
                    'support' => $objeto['support']

                ]);
          
            }

        }   
    }
