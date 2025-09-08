<?php

namespace Database\Seeders;

use App\Models\LugarInteres;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LugarInteresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lugares = [
            [
                'nombre' => 'Centro Histórico',
                'direccion' => 'Plaza Principal, Centro de la Ciudad',
                'web' => 'https://centrohistorico.com',
                'estatus' => 'activo',
                'descripcion' => 'Zona histórica con arquitectura colonial y museos importantes.'
            ],
            [
                'nombre' => 'Parque Nacional',
                'direccion' => 'Carretera Principal Km 15',
                'web' => 'https://parquenacional.gov',
                'estatus' => 'activo',
                'descripcion' => 'Reserva natural con senderos y miradores panorámicos.'
            ],
            [
                'nombre' => 'Museo de Arte',
                'direccion' => 'Av. Cultura 123',
                'web' => 'https://museoarte.org',
                'estatus' => 'activo',
                'descripcion' => 'Museo con colección de arte contemporáneo y exposiciones temporales.'
            ],
            [
                'nombre' => 'Mercado Artesanal',
                'direccion' => 'Calle Artesanos 456',
                'web' => null,
                'estatus' => 'activo',
                'descripcion' => 'Mercado tradicional con productos artesanales locales.'
            ],
            [
                'nombre' => 'Mirador Turístico',
                'direccion' => 'Cerro del Mirador, Zona Norte',
                'web' => 'https://mirador.com',
                'estatus' => 'inactivo',
                'descripcion' => 'Mirador con vista panorámica de la ciudad (temporalmente cerrado por mantenimiento).'
            ]
        ];

        foreach ($lugares as $lugar) {
            LugarInteres::create($lugar);
        }
    }
}
