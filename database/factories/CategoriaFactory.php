<?php

// database/factories/CategoriaFactory.php
namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,  // Genera un nombre aleatorio para la categoría
        ];
    }
}

