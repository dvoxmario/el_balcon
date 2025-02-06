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
        Schema::create('permission_rols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')  // aqui se define el nombre de la columna, llave foranea singular y termina en _id
            ->constrained('rols')  //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('permission_id')  // aqui se define el nombre de la columna, llave foranea singular y termina en _id
            ->constrained('permissions')  //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');




            //relations

            $table->timestamps();
            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_rols');
    }
};
