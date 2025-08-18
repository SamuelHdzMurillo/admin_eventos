<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'nombre_evento',
        'inicio_evento',
        'fin_evento',
        'sede_evento',
        'lim_de_participantes_evento',
        'estatus_evento'
    ];

    protected $casts = [
        'inicio_evento' => 'datetime',
        'fin_evento' => 'datetime',
    ];

    // Relación con equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
} 