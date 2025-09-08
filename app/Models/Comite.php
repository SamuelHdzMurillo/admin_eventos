<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'nombre',
        'rol',
        'puesto',
        'telefono',
        'extension'
    ];

    /**
     * Relación con el modelo Evento
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
