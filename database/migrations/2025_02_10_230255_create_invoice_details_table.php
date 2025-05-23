<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('value');



            //relations
            $table->foreignId('invoice_id')
            ->constrained('invoice_details') //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreignId('product_id')
            ->constrained('invoice_details') //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
