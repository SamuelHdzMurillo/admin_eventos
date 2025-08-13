<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedulaRegistro extends Model
{
    use HasFactory;

    protected $table = 'cedulas_registro';

    protected $fillable = [
        'equipo_id',
        'participantes',
        'asesores',
        'estado'
    ];

    protected $casts = [
        'participantes' => 'array',
        'asesores' => 'array',
    ];

    // Relación con equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
} 