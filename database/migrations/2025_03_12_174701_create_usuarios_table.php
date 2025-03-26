<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger por defecto
            $table->string('name');
            $table->string('email')->unique();  // Campo email único para autenticación
            $table->string('password');  // Campo para almacenar la contraseña
            $table->timestamp('fecha_registro')->useCurrent();
            $table->rememberToken(); // Este campo es necesario para "Remember Me"
            $table->timestamps(); // Otros timestamps estándar de Laravel
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
