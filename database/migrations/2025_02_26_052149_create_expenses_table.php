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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('support');


            //relations
            $table->foreignId('stock_id')
            ->constrained('stocks')  //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('responsible_id')
            ->constrained('users')  //  nombre de la tabla de referencia.
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
        Schema::dropIfExists('expenses');
    }
};
