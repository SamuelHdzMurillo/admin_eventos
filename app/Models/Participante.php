<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';

    protected $fillable = [
        'equipo_id',
        'nombre_participante',
        'rol_participante',
        'talla_participante',
        'telefono_participante',
        'matricula_participante',
        'correo_participante',
        'plantel_participante',
        'plantelcct',
        'medicamentos',
        'foto_credencial',
        'semestre_participante',
        'especialidad_participante',
        'seguro_facultativo',
        'tipo_sangre_participante',
        'alergico',
        'alergias'
    ];

    protected $casts = [
        'seguro_facultativo' => 'boolean',
        'alergico' => 'boolean',
    ];

    // Relación con equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
} 