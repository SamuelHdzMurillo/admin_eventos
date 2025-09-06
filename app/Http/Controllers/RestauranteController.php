<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'estatus' => 'required|in:activo,inactivo,cerrado',
            'direccion' => 'required|string',
            'telefono' => 'required|string|max:20',
            'correo_electronico' => 'required|email|max:255',
            'pagina_web' => 'nullable|url|max:255',
            'codigo_promocional' => 'nullable|string|max:50',
            'descripcion_codigo_promocional' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Procesar la imagen si se subió
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = 'restaurante_' . Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Guardar la imagen
            $image->storeAs('public/restaurantes', $imageName);
            
            // Actualizar la ruta de la imagen
            $data['imagen'] = 'restaurantes/' . $imageName;
        }

        $restaurante = Restaurante::create($data);

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
            'nombre' => 'sometimes|required|string|max:255',
            'estatus' => 'sometimes|required|in:activo,inactivo,cerrado',
            'direccion' => 'sometimes|required|string',
            'telefono' => 'sometimes|required|string|max:20',
            'correo_electronico' => 'sometimes|required|email|max:255',
            'pagina_web' => 'nullable|url|max:255',
            'codigo_promocional' => 'nullable|string|max:50',
            'descripcion_codigo_promocional' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Procesar la nueva imagen si se subió
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($restaurante->imagen && Storage::disk('public')->exists($restaurante->imagen)) {
                Storage::disk('public')->delete($restaurante->imagen);
            }

            $image = $request->file('imagen');
            $imageName = 'restaurante_' . Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Guardar la nueva imagen
            $image->storeAs('public/restaurantes', $imageName);
            
            // Actualizar la ruta de la imagen
            $data['imagen'] = 'restaurantes/' . $imageName;
        }

        $restaurante->update($data);

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
     * Get the image of the specified restaurant.
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

        if (!$restaurante->imagen) {
            return response()->json([
                'success' => false,
                'message' => 'No hay imagen disponible para este restaurante'
            ], 404);
        }

        $imagePath = storage_path('app/public/' . $restaurante->imagen);

        if (!file_exists($imagePath)) {
            return response()->json([
                'success' => false,
                'message' => 'La imagen no existe en el servidor'
            ], 404);
        }

        return response()->file($imagePath);
    }
}
