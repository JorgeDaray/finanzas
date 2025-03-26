<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger por defecto
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('categoria_id');
            $table->enum('tipo', ['ingreso', 'gasto']);
            $table->decimal('monto', 10, 2);
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
}
