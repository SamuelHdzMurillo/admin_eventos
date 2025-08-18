<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\AcompananteController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\CedulaRegistroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas públicas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    
    // Información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Rutas de autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);

    // Rutas para usuarios autenticados (cualquier rol)
    Route::get('/eventos', [EventoController::class, 'index']);
    Route::get('/eventos/{evento}', [EventoController::class, 'show']);
    
    Route::get('/equipos', [EquipoController::class, 'index']);
    Route::get('/equipos/{equipo}', [EquipoController::class, 'show']);
    Route::get('/equipos/{equipo}/completo', [EquipoController::class, 'getEquipoCompleto']);
    
    Route::get('/participantes', [ParticipanteController::class, 'index']);
    Route::get('/participantes/{participante}', [ParticipanteController::class, 'show']);
    Route::get('/participantes/{participante}/credencial', [ParticipanteController::class, 'getCredencialImage']);
    
    Route::get('/acompanantes', [AcompananteController::class, 'index']);
    Route::get('/acompanantes/{acompanante}', [AcompananteController::class, 'show']);
    
    Route::get('/recetas', [RecetaController::class, 'index']);
    Route::get('/recetas/{receta}', [RecetaController::class, 'show']);
    
    Route::get('/cedulas-registro', [CedulaRegistroController::class, 'index']);
    Route::get('/cedulas-registro/{cedulaRegistro}', [CedulaRegistroController::class, 'show']);

    // Rutas solo para administradores
   // Route::middleware('role:admin')->group(function () {
        
        // Administración de usuarios
        Route::apiResource('admin/users', AdminController::class);
        Route::put('admin/users/{user}/role', [AdminController::class, 'changeRole']);
        Route::get('admin/users-stats', [AdminController::class, 'stats']);
        
        // CRUD completo para eventos
        Route::apiResource('eventos', EventoController::class);
        
        // CRUD completo para equipos
        Route::apiResource('equipos', EquipoController::class);
        
        // CRUD completo para participantes
        Route::apiResource('participantes', ParticipanteController::class);
        
        // CRUD completo para acompañantes
        Route::apiResource('acompanantes', AcompananteController::class);
        
        // CRUD completo para recetas
        Route::apiResource('recetas', RecetaController::class);
        
        // CRUD completo para cédulas de registro
        Route::apiResource('cedulas-registro', CedulaRegistroController::class);
   // });
});
