<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\AcompananteController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\CedulaRegistroController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para Eventos
Route::apiResource('eventos', EventoController::class);

// Rutas para Equipos
Route::apiResource('equipos', EquipoController::class);
Route::get('equipos/{equipo}/completo', [EquipoController::class, 'getEquipoCompleto']);

// Rutas para Participantes
Route::apiResource('participantes', ParticipanteController::class);

// Rutas para Acompañantes
Route::apiResource('acompanantes', AcompananteController::class);

// Rutas para Recetas
Route::apiResource('recetas', RecetaController::class);

// Rutas para Cédulas de Registro
Route::apiResource('cedulas-registro', CedulaRegistroController::class);
