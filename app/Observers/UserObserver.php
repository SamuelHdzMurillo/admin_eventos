<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Equipo;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Crear un equipo automáticamente para el usuario si no tiene uno asignado
        if (!$user->equipo_id) {
            $equipo = Equipo::create([
                'nombre_equipo' => 'Equipo de ' . $user->name,
                'evento_id' => $user->evento_id,
                'entidad_federativa' => 'Por definir',
                'estatus_del_equipo' => 'Activo',
                'nombre_anfitrion' => $user->name,
                'telefono_anfitrion' => 'Sin teléfono',
                'correo_anfitrion' => $user->email
            ]);

            // Asignar el equipo creado al usuario
            $user->update(['equipo_id' => $equipo->id]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
