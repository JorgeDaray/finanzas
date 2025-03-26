<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger por defecto
            $table->unsignedBigInteger('usuario_id');
            $table->string('nombre');
            $table->decimal('saldo', 10, 2);
            $table->enum('tipo', ['ahorro', 'corriente', 'tarjeta']);
            $table->timestamps();

            // Clave foránea
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}
