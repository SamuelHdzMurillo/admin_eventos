<?php

namespace App\Http\Controllers;

use App\Models\Acompanante;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AcompananteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $acompanantes = Acompanante::with('equipo')->get();
        
        return response()->json([
            'success' => true,
            'data' => $acompanantes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'nombre_acompanante' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'puesto' => 'required|string|max:255',
            'talla' => 'required|string|max:10',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255'
        ]);

        $acompanante = Acompanante::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Acompañante creado exitosamente',
            'data' => $acompanante
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Acompanante $acompanante): JsonResponse
    {
        $acompanante->load('equipo');

        return response()->json([
            'success' => true,
            'data' => $acompanante
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acompanante $acompanante): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'sometimes|exists:equipos,id',
            'nombre_acompanante' => 'sometimes|string|max:255',
            'rol' => 'sometimes|string|max:255',
            'puesto' => 'sometimes|string|max:255',
            'talla' => 'sometimes|string|max:10',
            'telefono' => 'sometimes|string|max:20',
            'email' => 'sometimes|email|max:255'
        ]);

        $acompanante->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Acompañante actualizado exitosamente',
            'data' => $acompanante
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acompanante $acompanante): JsonResponse
    {
        $acompanante->delete();

        return response()->json([
            'success' => true,
            'message' => 'Acompañante eliminado exitosamente'
        ]);
    }
} 