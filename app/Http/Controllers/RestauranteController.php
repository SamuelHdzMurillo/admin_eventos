<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $restaurantes = Restaurante::all();
        
        return response()->json([
            'success' => true,
            'data' => $restaurantes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estatus' => 'nullable|in:activo,inactivo,cerrado',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'correo_electronico' => 'nullable|string|max:255',
            'pagina_web' => 'nullable|string|max:255',
            'codigo_promocional' => 'nullable|string|max:50',
            'descripcion_codigo_promocional' => 'nullable|string',
            'imagen' => 'nullable|string|max:500'
        ]);

        $restaurante = Restaurante::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Restaurante creado exitosamente',
            'data' => $restaurante
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $restaurante = Restaurante::find($id);

        if (!$restaurante) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $restaurante
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $restaurante = Restaurante::find($id);

        if (!$restaurante) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'estatus' => 'nullable|in:activo,inactivo,cerrado',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'correo_electronico' => 'nullable|string|max:255',
            'pagina_web' => 'nullable|string|max:255',
            'codigo_promocional' => 'nullable|string|max:50',
            'descripcion_codigo_promocional' => 'nullable|string',
            'imagen' => 'nullable|string|max:500'
        ]);

        $restaurante->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Restaurante actualizado exitosamente',
            'data' => $restaurante
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $restaurante = Restaurante::find($id);

        if (!$restaurante) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }

        $restaurante->delete();

        return response()->json([
            'success' => true,
            'message' => 'Restaurante eliminado exitosamente'
        ]);
    }

    /**
     * Get the image URL of the specified restaurant.
     */
    public function getImagen(string $id): JsonResponse
    {
        $restaurante = Restaurante::find($id);

        if (!$restaurante) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'imagen' => $restaurante->imagen
            ]
        ]);
    }
}
