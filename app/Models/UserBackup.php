<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;  // Necesario para la autenticación

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';  // Si la tabla se llama 'usuarios'

    // Relación con las transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'usuario_id');
    }

    // Relación con las cuentas
    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'usuario_id');
    }
}
