<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarInteres extends Model
{
    use HasFactory;

    protected $table = 'lugares_interes';

    protected $fillable = [
        'nombre',
        'direccion',
        'web',
        'estatus',
        'descripcion',
        'img'
    ];

    protected $casts = [
        'estatus' => 'string'
    ];
}
