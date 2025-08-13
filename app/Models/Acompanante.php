<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompanante extends Model
{
    use HasFactory;

    protected $table = 'acompanantes';

    protected $fillable = [
        'equipo_id',
        'nombre_acompanante',
        'rol',
        'puesto',
        'talla',
        'telefono',
        'email'
    ];

    // Relación con equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
} 