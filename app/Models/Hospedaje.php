<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model
{
    use HasFactory;

    protected $table = 'hospedajes';

    protected $fillable = [
        'nombre',
        'direccion',
        'numero_telefonico',
        'correo',
        'img'
    ];

    // Relación con eventos (si se necesita en el futuro)
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_hospedaje');
    }
}
