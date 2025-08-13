<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'recetas';

    protected $fillable = [
        'equipo_id',
        'tipo_receta',
        'descripcion',
        'ingredientes',
        'preparacion',
        'observaciones',
        'creado_por',
        'fecha_creacion'
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
    ];

    // Relación con equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
} 