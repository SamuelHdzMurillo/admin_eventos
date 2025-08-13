<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $eventos = Evento::with('equipos')->get();
        
        return response()->json([
            'success' => true,
            'data' => $eventos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'inicio_evento' => 'required|date',
            'fin_evento' => 'required|date|after:inicio_evento',
            'sede_evento' => 'required|string|max:255',
            'lim_de_participantes_evento' => 'required|integer|min:1',
            'estatus_evento' => 'required|in:activo,inactivo,cancelado,finalizado'
        ]);

        $evento = Evento::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Evento creado exitosamente',
            'data' => $evento
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento): JsonResponse
    {
        $evento->load('equipos');

        return response()->json([
            'success' => true,
            'data' => $evento
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento): JsonResponse
    {
        $request->validate([
            'nombre_evento' => 'sometimes|string|max:255',
            'inicio_evento' => 'sometimes|date',
            'fin_evento' => 'sometimes|date|after:inicio_evento',
            'sede_evento' => 'sometimes|string|max:255',
            'lim_de_participantes_evento' => 'sometimes|integer|min:1',
            'estatus_evento' => 'sometimes|in:activo,inactivo,cancelado,finalizado'
        ]);

        $evento->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Evento actualizado exitosamente',
            'data' => $evento
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento): JsonResponse
    {
        $evento->delete();

        return response()->json([
            'success' => true,
            'message' => 'Evento eliminado exitosamente'
        ]);
    }
} 