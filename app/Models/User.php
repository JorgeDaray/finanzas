<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaccion;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'fecha_registro'];

    // Definir que la columna 'correo' es el campo del correo
    public function getEmailAttribute()
    {
        return $this->attributes['email'];
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

    // app/Models/User.php
    // Relación muchos a muchos con roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}


