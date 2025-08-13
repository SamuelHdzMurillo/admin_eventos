<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $recetas = Receta::with('equipo')->get();
        
        return response()->json([
            'success' => true,
            'data' => $recetas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'tipo_receta' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ingredientes' => 'required|string',
            'preparacion' => 'required|string',
            'observaciones' => 'nullable|string',
            'creado_por' => 'required|string|max:255'
        ]);

        $receta = Receta::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Receta creada exitosamente',
            'data' => $receta
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta): JsonResponse
    {
        $receta->load('equipo');

        return response()->json([
            'success' => true,
            'data' => $receta
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'sometimes|exists:equipos,id',
            'tipo_receta' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'ingredientes' => 'sometimes|string',
            'preparacion' => 'sometimes|string',
            'observaciones' => 'nullable|string',
            'creado_por' => 'sometimes|string|max:255'
        ]);

        $receta->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Receta actualizada exitosamente',
            'data' => $receta
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receta $receta): JsonResponse
    {
        $receta->delete();

        return response()->json([
            'success' => true,
            'message' => 'Receta eliminada exitosamente'
        ]);
    }
} 