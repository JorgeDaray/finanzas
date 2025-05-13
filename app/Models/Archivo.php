<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'transaccion_id'];

    public function transaccion()
    {
        return $this->belongsTo(Transaccion::class);
    }
}

