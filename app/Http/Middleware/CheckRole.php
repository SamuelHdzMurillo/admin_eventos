<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado. Usuario no autenticado.'
            ], 401);
        }

        $user = $request->user();
        
        // Si no se especifican roles, permitir acceso a cualquier usuario autenticado
        if (empty($roles)) {
            return $next($request);
        }

        // Verificar si el usuario tiene alguno de los roles requeridos
        if (!$user->hasAnyRole($roles)) {
            return response()->json([
                'success' => false,
                'message' => 'Acceso denegado. No tienes permisos para realizar esta acción.'
            ], 403);
        }

        return $next($request);
    }
} 