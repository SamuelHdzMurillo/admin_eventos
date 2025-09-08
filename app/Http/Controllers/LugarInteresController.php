<?php

namespace App\Http\Controllers;

use App\Models\LugarInteres;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LugarInteresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $lugares = LugarInteres::all();
        return response()->json($lugares);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'web' => 'nullable|url',
            'estatus' => 'required|in:activo,inactivo',
            'descripcion' => 'nullable|string'
        ]);

        $lugar = LugarInteres::create($request->all());
        return response()->json($lugar, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $lugar = LugarInteres::findOrFail($id);
        return response()->json($lugar);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'direccion' => 'sometimes|required|string',
            'web' => 'nullable|url',
            'estatus' => 'sometimes|required|in:activo,inactivo',
            'descripcion' => 'nullable|string'
        ]);

        $lugar = LugarInteres::findOrFail($id);
        $lugar->update($request->all());
        return response()->json($lugar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $lugar = LugarInteres::findOrFail($id);
        $lugar->delete();
        return response()->json(['message' => 'Lugar de interés eliminado correctamente']);
    }
}
