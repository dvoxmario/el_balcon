
<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Ruta para iniciar sesión (login)
Route::post('login', [AuthController::class, 'login']);

// Ruta para obtener los datos del usuario autenticado
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');

// Ruta para cerrar sesión (logout)
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
