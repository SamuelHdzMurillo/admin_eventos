<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = [
        'nombre',
        'estatus',
        'direccion',
        'telefono',
        'correo_electronico',
        'pagina_web',
        'codigo_promocional',
        'descripcion_codigo_promocional',
        'imagen'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
