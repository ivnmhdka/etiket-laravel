<?php

use App\Http\Controllers\Api\Admin\TicketController;
use App\Http\Controllers\Api\Admin\TransactionController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\BookTicketController;
use App\Http\Controllers\Api\User\MyOrderController;
use App\Http\Controllers\Api\User\TicketController as UserTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('user')->middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::get('my-order', [MyOrderController::class, 'index']);
    Route::post('order-ticket/{ticket:slug}', [BookTicketController::class, 'store']);
    Route::post('process-payment', [MyOrderController::class, 'processPaymentTicket']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('ticket', TicketController::class);
    Route::resource('transaction', TransactionController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('tickets', [UserTicketController::class, 'index']);
Route::get('tickets/{ticket:slug}', [UserTicketController::class, 'show']);
