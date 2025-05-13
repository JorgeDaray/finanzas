<?php

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Transaccion;
use App\Models\Categoria;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 usuarios
        User::factory(10)->create();

        // Crear 5 categorías
        Categoria::factory(5)->create();  // Asegúrate de que el factory de Categoria se esté utilizando correctamente

        // Crear 20 transacciones
        Transaccion::factory(20)->create();
    }
}

