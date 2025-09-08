<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $comites = Comite::with('evento')->get();
        
        return response()->json([
            'success' => true,
            'data' => $comites
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'nombre' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'puesto' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'extension' => 'nullable|string|max:10'
        ]);

        $comite = Comite::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Miembro del comité creado exitosamente',
            'data' => $comite
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comite $comite): JsonResponse
    {
        $comite->load('evento');

        return response()->json([
            'success' => true,
            'data' => $comite
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comite $comite): JsonResponse
    {
        $request->validate([
            'evento_id' => 'sometimes|exists:eventos,id',
            'nombre' => 'sometimes|string|max:255',
            'rol' => 'sometimes|string|max:255',
            'puesto' => 'sometimes|string|max:255',
            'telefono' => 'sometimes|string|max:20',
            'extension' => 'nullable|string|max:10'
        ]);

        $comite->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Miembro del comité actualizado exitosamente',
            'data' => $comite
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comite $comite): JsonResponse
    {
        $comite->delete();

        return response()->json([
            'success' => true,
            'message' => 'Miembro del comité eliminado exitosamente'
        ]);
    }
}
