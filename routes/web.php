<?php

use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceStatusController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRolController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('identification_type', IdentificationTypeController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('rol', RolController::class);
Route::apiResource('UserRol', UserRolController::class);
Route::apiResource('price', PriceController::class);
Route::apiResource('roomC', RoomCategoryController::class);
Route::apiResource('Room', RoomController::class);
Route::apiResource('invoiceStatus', InvoiceStatusController::class);
Route::apiResource('invoice', InvoiceController::class);
Route::apiResource('reservation', ReservationController::class);
