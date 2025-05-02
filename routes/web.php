<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\IncomeController;
<<<<<<< HEAD
use App\Http\Controllers\IncomeDetailController;
=======
use App\Http\Controllers\IncomeDetailDetailController;
>>>>>>> ca326f29e5e41228c0443081214cebdfb2bdfc80
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoicePaymentController;
use App\Http\Controllers\InvoiceStatusController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRolController;
use App\Models\Expense;
use App\Models\PaymentMethod;
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
Route::apiResource('paymentMethod', PaymentMethodController::class);
Route::apiResource('invoicePayment', InvoicePaymentController::class);
Route::apiResource('invoiceDetail', InvoiceDetailController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('stock', StockController::class);
Route::apiResource('expense', ExpenseController::class);
Route::apiResource('income', IncomeController::class);
Route::apiResource('incomeDetail', IncomeDetailDetailController::class);
