<?php

use App\Http\Controllers\IdentificationTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('identification_type', IdentificationTypeController::class);
