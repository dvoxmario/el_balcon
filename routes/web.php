<?php

use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('identification_type', IdentificationTypeController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('rol', RolController::class);
Route::apiResource('UserRol', UserRolController::class);
Route::apiResource('price', PriceController::class);

