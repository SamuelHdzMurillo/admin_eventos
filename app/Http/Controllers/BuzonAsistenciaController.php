<?php

namespace App\Http\Controllers;

use App\Models\BuzonAsistencia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BuzonAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $buzonAsistencia = BuzonAsistencia::with(['evento', 'equipo'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $buzonAsistencia
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'evento_id' => 'required|exists:eventos,id',
                'equipo_id' => 'nullable|exists:equipos,id',
                'correo_electronico' => 'required|email|max:255',
                'telefono' => 'required|string|max:20',
                'mensaje' => 'required|string',
                'estado' => 'nullable|in:pendiente,en_proceso,resuelto,cancelado'
            ]);

            $buzonAsistencia = BuzonAsistencia::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Mensaje de asistencia creado exitosamente',
                'data' => $buzonAsistencia->load(['evento', 'equipo'])
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $buzonAsistencia = BuzonAsistencia::with(['evento', 'equipo'])->find($id);

        if (!$buzonAsistencia) {
            return response()->json([
                'success' => false,
                'message' => 'Mensaje de asistencia no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $buzonAsistencia
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $buzonAsistencia = BuzonAsistencia::find($id);

            if (!$buzonAsistencia) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mensaje de asistencia no encontrado'
                ], 404);
            }

            $validated = $request->validate([
                'atendido' => 'nullable|boolean',
                'estado' => 'nullable|in:pendiente,en_proceso,resuelto,cancelado',
                'correo_electronico' => 'nullable|email|max:255',
                'telefono' => 'nullable|string|max:20',
                'mensaje' => 'nullable|string'
            ]);

            $buzonAsistencia->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Mensaje de asistencia actualizado exitosamente',
                'data' => $buzonAsistencia->load(['evento', 'equipo'])
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $buzonAsistencia = BuzonAsistencia::find($id);

        if (!$buzonAsistencia) {
            return response()->json([
                'success' => false,
                'message' => 'Mensaje de asistencia no encontrado'
            ], 404);
        }

        $buzonAsistencia->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mensaje de asistencia eliminado exitosamente'
        ]);
    }

    /**
     * Marcar como atendido
     */
    public function marcarAtendido(string $id): JsonResponse
    {
        $buzonAsistencia = BuzonAsistencia::find($id);

        if (!$buzonAsistencia) {
            return response()->json([
                'success' => false,
                'message' => 'Mensaje de asistencia no encontrado'
            ], 404);
        }

        $buzonAsistencia->update([
            'atendido' => true,
            'estado' => 'resuelto'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mensaje marcado como atendido',
            'data' => $buzonAsistencia->load(['evento', 'equipo'])
        ]);
    }

    /**
     * Obtener mensajes por estado
     */
    public function porEstado(string $estado): JsonResponse
    {
        $buzonAsistencia = BuzonAsistencia::with(['evento', 'equipo'])
            ->where('estado', $estado)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $buzonAsistencia
        ]);
    }
}
