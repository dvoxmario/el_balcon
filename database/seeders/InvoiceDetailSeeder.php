<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objetos=[

        [     

           'name' => 'detalles factura',
           'value_id' => '1',
           'invoice_id'=>'2',
           'product_id'=>'4',

        ],

        ];
        foreach ($objetos as $key => $objeto){
            InvoiceDetail::create([
                'name'=> $objeto['name'],
                'value'=> $objeto['value_id'],
                'invoice_id'=> $objeto['invoice_id'],
                'product_id'=> $objeto['product_id'],

            ]);    


 
    
        }     

    }
}
