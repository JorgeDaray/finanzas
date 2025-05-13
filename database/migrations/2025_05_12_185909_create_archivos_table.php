<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('archivo');
            $table->unsignedBigInteger('transaccion_id'); // Asegúrate de que esta columna es unsignedBigInteger
            $table->timestamps();

            // Asegúrate de que el nombre de la tabla sea correcto
            $table->foreign('transaccion_id')->references('id')->on('transacciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
