<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $participantes = Participante::with('equipo')->get();
        
        return response()->json([
            'success' => true,
            'data' => $participantes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'nombre_participante' => 'required|string|max:255',
            'rol_participante' => 'required|string|max:255',
            'talla_participante' => 'required|string|max:10',
            'telefono_participante' => 'required|string|max:20',
            'matricula_participante' => 'required|string|max:50',
            'correo_participante' => 'required|email|max:255',
            'plantel_participante' => 'required|string|max:255',
            'plantelcct' => 'required|string|max:50',
            'medicamentos' => 'nullable|string',
            'foto_credencial' => 'nullable|string|url|max:500', // URL de imagen
            'semestre_participante' => 'required|string|max:50',
            'especialidad_participante' => 'required|string|max:255',
            'seguro_facultativo' => 'boolean',
            'numero_seguro_social' => 'nullable|string|max:20',
            'nombre_contacto_emergencia' => 'nullable|string|max:255',
            'telefono_contacto_emergencia' => 'nullable|string|max:20',
            'tipo_sangre_participante' => 'required|string|max:10',
            'alergico' => 'boolean',
            'alergias' => 'nullable|string'
        ]);

        $data = $request->all();

        // La foto_credencial ahora es una URL que se guarda directamente
        // No se requiere procesamiento adicional

        $participante = Participante::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Participante creado exitosamente',
            'data' => $participante
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Participante $participante): JsonResponse
    {
        $participante->load('equipo');

        return response()->json([
            'success' => true,
            'data' => $participante
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participante $participante): JsonResponse
    {
        $request->validate([
            'equipo_id' => 'sometimes|exists:equipos,id',
            'nombre_participante' => 'sometimes|string|max:255',
            'rol_participante' => 'sometimes|string|max:255',
            'talla_participante' => 'sometimes|string|max:10',
            'telefono_participante' => 'sometimes|string|max:20',
            'matricula_participante' => 'sometimes|string|max:50',
            'correo_participante' => 'sometimes|email|max:255',
            'plantel_participante' => 'sometimes|string|max:255',
            'plantelcct' => 'sometimes|string|max:50',
            'medicamentos' => 'nullable|string',
            'foto_credencial' => 'nullable|string|url|max:500', // URL de imagen
            'semestre_participante' => 'sometimes|string|max:50',
            'especialidad_participante' => 'sometimes|string|max:255',
            'seguro_facultativo' => 'sometimes|boolean',
            'numero_seguro_social' => 'nullable|string|max:20',
            'nombre_contacto_emergencia' => 'nullable|string|max:255',
            'telefono_contacto_emergencia' => 'nullable|string|max:20',
            'tipo_sangre_participante' => 'sometimes|string|max:10',
            'alergico' => 'sometimes|boolean',
            'alergias' => 'nullable|string'
        ]);

        $data = $request->all();

        // La foto_credencial ahora es una URL que se guarda directamente
        // No se requiere procesamiento adicional

        $participante->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Participante actualizado exitosamente',
            'data' => $participante
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participante $participante): JsonResponse
    {
        // Eliminar la imagen si existe
        if ($participante->foto_credencial && Storage::disk('public')->exists($participante->foto_credencial)) {
            Storage::disk('public')->delete($participante->foto_credencial);
        }

        $participante->delete();

        return response()->json([
            'success' => true,
            'message' => 'Participante eliminado exitosamente'
        ]);
    }

    /**
     * Obtener la imagen de credencial
     */
    public function getCredencialImage(Participante $participante): JsonResponse
    {
        if (!$participante->foto_credencial) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró imagen de credencial para este participante'
            ], 404);
        }

        if (!Storage::disk('public')->exists($participante->foto_credencial)) {
            return response()->json([
                'success' => false,
                'message' => 'La imagen de credencial no existe en el servidor'
            ], 404);
        }

        $url = Storage::disk('public')->url($participante->foto_credencial);

        return response()->json([
            'success' => true,
            'data' => [
                'image_url' => $url,
                'filename' => $participante->foto_credencial
            ]
        ]);
    }
} 