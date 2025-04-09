<?php

use App\Models\Invoice;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('value');


            $table->foreignId('reservation_id')
            ->constrained('reservations')  //  nombre de la tabla de referencia.
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('invoice_state_id')
            ->constrained('invoices')  //  nombre de la tabla de referencia.
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
        Schema::dropIfExists('invoices');
    }
};
