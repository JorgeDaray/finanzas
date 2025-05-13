<?php

// database/factories/TransaccionFactory.php
namespace Database\Factories;

use App\Models\Transaccion;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaccionFactory extends Factory
{
    protected $model = Transaccion::class;

    public function definition()
    {
        return [
            'usuario_id' => User::factory(),  // Relación con User (crea un usuario con el factory)
            'categoria_id' => Categoria::factory(),  // Relación con Categoria (crea una categoría)
            'tipo' => $this->faker->randomElement(['ingreso', 'gasto']),
            'monto' => $this->faker->randomFloat(2, 100, 1000),
            'descripcion' => $this->faker->sentence(),
            'fecha' => $this->faker->date(),
        ];
    }
}

