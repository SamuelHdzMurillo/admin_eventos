<?php

namespace App\Http\Controllers;

use App\Models\CedulaRegistro;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CedulaRegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $cedulas = CedulaRegistro::with('equipo')->get();
        
        return response()->json([
            'success' => true,
            'data' => $cedulas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'participantes' => 'required|array',
            'asesores' => 'required|array',
            'estado' => 'required|in:pendiente,aprobada,rechazada'
        ]);

        $cedula = CedulaRegistro::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cédula de registro creada exitosamente',
            'data' => $cedula
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CedulaRegistro $cedulaRegistro): JsonResponse
    {
        $cedulaRegistro->load('equipo');

        return response()->json([
            'success' => true,
            'data' => $cedulaRegistro
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CedulaRegistro $cedulaRegistro): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'sometimes|exists:equipos,id',
            'participantes' => 'sometimes|array',
            'asesores' => 'sometimes|array',
            'estado' => 'sometimes|in:pendiente,aprobada,rechazada'
        ]);

        $cedulaRegistro->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cédula de registro actualizada exitosamente',
            'data' => $cedulaRegistro
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CedulaRegistro $cedulaRegistro): JsonResponse
    {
        $cedulaRegistro->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cédula de registro eliminada exitosamente'
        ]);
    }
} 