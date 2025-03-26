<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Agregar la columna 'nombre' al fillable
    protected $fillable = ['nombre'];

    // Relación con las transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'categoria_id');
    }
}
