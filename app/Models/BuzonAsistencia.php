<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuzonAsistencia extends Model
{
    use HasFactory;

    protected $table = 'buzon_asistencia';

    protected $fillable = [
        'atendido',
        'evento_id',
        'equipo_id',
        'estado',
        'correo_electronico',
        'telefono',
        'mensaje'
    ];

    protected $casts = [
        'atendido' => 'boolean',
    ];

    // Relación con Evento
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    // Relación con Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
