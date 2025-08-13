<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'nombre_equipo',
        'evento_id',
        'entidad_federativa',
        'estatus_del_equipo',
        'nombre_anfitrion',
        'telefono_anfitrion',
        'correo_anfitrion'
    ];

    // Relación con evento
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    // Relación con participantes
    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }

    // Relación con acompañantes
    public function acompanantes()
    {
        return $this->hasMany(Acompanante::class);
    }

    // Relación con recetas
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    // Relación con cédulas de registro
    public function cedulasRegistro()
    {
        return $this->hasMany(CedulaRegistro::class);
    }
} 