<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}

