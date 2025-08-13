<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@eventos.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Crear usuario regular
        User::create([
            'name' => 'Usuario Regular',
            'email' => 'usuario@eventos.com',
            'password' => Hash::make('usuario123'),
            'role' => 'usuario'
        ]);

        // Crear algunos usuarios adicionales para pruebas
        User::create([
            'name' => 'María García',
            'email' => 'maria@eventos.com',
            'password' => Hash::make('password123'),
            'role' => 'usuario'
        ]);

        User::create([
            'name' => 'Carlos López',
            'email' => 'carlos@eventos.com',
            'password' => Hash::make('password123'),
            'role' => 'usuario'
        ]);
    }
} 