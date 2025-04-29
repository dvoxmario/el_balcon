<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password')->nullable();
            $table->string('identifiers')->unique();
            $table->foreignId('responsible')->nullable();




            //relations
            $table->foreignId('identification_type_id')  // aqui se define el nombre de la columna, llave foranea singular y termina en _id
            ->constrained('identification_types')  //  nombre de la tabla de referencia.
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
        Schema::dropIfExists('users');

    }
};
