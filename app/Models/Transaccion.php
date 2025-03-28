<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    // Especifica la tabla que se utilizará en este modelo (si el nombre de la tabla no sigue la convención de pluralización)
    protected $table = 'transacciones'; 

    // Permite la asignación masiva de estos campos
    protected $fillable = [
        'usuario_id', 
        'categoria_id', 
        'tipo', 
        'monto', 
        'descripcion', 
        'fecha'
    ];

    // Relación con el Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // Transacción pertenece a un Usuario
    }

    // Relación con la Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id'); // Transacción pertenece a una Categoría
    }
}

