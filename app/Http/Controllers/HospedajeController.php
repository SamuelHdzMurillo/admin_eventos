<?php

namespace App\Http\Controllers;

use App\Models\Hospedaje;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HospedajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $hospedajes = Hospedaje::all();
        
        return response()->json([
            'success' => true,
            'data' => $hospedajes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'numero_telefonico' => 'required|string|max:20',
            'correo' => 'required|email|max:255',
            'img' => 'nullable|string|max:255'
        ]);

        $hospedaje = Hospedaje::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Hospedaje creado exitosamente',
            'data' => $hospedaje
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospedaje $hospedaje): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $hospedaje
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospedaje $hospedaje): JsonResponse
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'direccion' => 'sometimes|string',
            'numero_telefonico' => 'sometimes|string|max:20',
            'correo' => 'sometimes|email|max:255',
            'img' => 'nullable|string|max:255'
        ]);

        $hospedaje->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Hospedaje actualizado exitosamente',
            'data' => $hospedaje
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospedaje $hospedaje): JsonResponse
    {
        $hospedaje->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hospedaje eliminado exitosamente'
        ]);
    }
}
