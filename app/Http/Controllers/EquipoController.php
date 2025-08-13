<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $equipos = Equipo::with(['evento', 'participantes', 'acompanantes', 'recetas', 'cedulasRegistro'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $equipos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre_equipo' => 'required|string|max:255',
            'evento_id' => 'required|exists:eventos,id',
            'entidad_federativa' => 'required|string|max:255',
            'estatus_del_equipo' => 'required|in:activo,inactivo,eliminado',
            'nombre_anfitrion' => 'required|string|max:255',
            'telefono_anfitrion' => 'required|string|max:20',
            'correo_anfitrion' => 'required|email|max:255'
        ]);

        $equipo = Equipo::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Equipo creado exitosamente',
            'data' => $equipo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo): JsonResponse
    {
        $equipo->load([
            'evento',
            'participantes',
            'acompanantes', 
            'recetas',
            'cedulasRegistro'
        ]);

        return response()->json([
            'success' => true,
            'data' => $equipo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo): JsonResponse
    {
        $request->validate([
            'nombre_equipo' => 'sometimes|string|max:255',
            'evento_id' => 'sometimes|exists:eventos,id',
            'entidad_federativa' => 'sometimes|string|max:255',
            'estatus_del_equipo' => 'sometimes|in:activo,inactivo,eliminado',
            'nombre_anfitrion' => 'sometimes|string|max:255',
            'telefono_anfitrion' => 'sometimes|string|max:20',
            'correo_anfitrion' => 'sometimes|email|max:255'
        ]);

        $equipo->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Equipo actualizado exitosamente',
            'data' => $equipo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo): JsonResponse
    {
        $equipo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Equipo eliminado exitosamente'
        ]);
    }

    /**
     * Obtener equipo con toda la información relacionada
     */
    public function getEquipoCompleto(Equipo $equipo): JsonResponse
    {
        $equipo->load([
            'evento',
            'participantes',
            'acompanantes',
            'recetas',
            'cedulasRegistro'
        ]);

        return response()->json([
            'success' => true,
            'data' => $equipo
        ]);
    }
} 