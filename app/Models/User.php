<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Cambié esto
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable // Cambié esto para extender de Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'fecha_registro'];

    // Definir que la columna 'correo' es el campo del correo
    public function getEmailAttribute()
    {
        return $this->attributes['email'];  // Asegúrate de que en tu base de datos sea 'correo'
    }

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

    // Si tu aplicación utiliza hashing para contraseñas, asegúrate de hacer esto:
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);  // Esto se asegura de que la contraseña esté cifrada
    }
}

