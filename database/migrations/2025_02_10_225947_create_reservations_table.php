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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('reservation_start_date');
            $table->date('reserrvation_finish_date');
            $table->date('check_in');
            $table->date('check_out');



            //relations
             
            $table->foreignId('cliente_id')
            ->constrained('users')  //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreignId('responsible_id')
            ->constrained('users')  //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreignId('room_id')
            ->constrained('rooms')  //  nombre de la tabla de referencia.
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
        Schema::dropIfExists('reservations');
    }
};
