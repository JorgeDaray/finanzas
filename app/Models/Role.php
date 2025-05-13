<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaccion;

class Role extends Model
{
    use HasFactory;

    // Relación muchos a muchos con usuarios
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}


