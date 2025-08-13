<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Listar todos los usuarios (solo admin)
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * Mostrar un usuario específico (solo admin)
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Crear un nuevo usuario (solo admin)
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,usuario'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente',
            'data' => $user
        ], 201);
    }

    /**
     * Actualizar un usuario (solo admin)
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8',
            'role' => 'sometimes|in:admin,usuario'
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->has('role')) {
            $user->role = $request->role;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente',
            'data' => $user
        ]);
    }

    /**
     * Eliminar un usuario (solo admin)
     */
    public function destroy(User $user): JsonResponse
    {
        // No permitir que un admin se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes eliminar tu propia cuenta'
            ], 400);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado exitosamente'
        ]);
    }

    /**
     * Cambiar rol de un usuario (solo admin)
     */
    public function changeRole(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'role' => 'required|in:admin,usuario'
        ]);

        // No permitir que un admin cambie su propio rol
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes cambiar tu propio rol'
            ], 400);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Rol del usuario cambiado exitosamente',
            'data' => $user
        ]);
    }

    /**
     * Obtener estadísticas de usuarios (solo admin)
     */
    public function stats(): JsonResponse
    {
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $regularUsers = User::where('role', 'usuario')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_users' => $totalUsers,
                'admin_users' => $adminUsers,
                'regular_users' => $regularUsers
            ]
        ]);
    }
} 