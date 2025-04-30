<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\PaymentController;

// API Ticket routes
Route::prefix('tickets')->name('api.tickets.')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::post('/', [TicketController::class, 'store'])->name('store');
    Route::get('/{id}', [TicketController::class, 'show'])->name('show');
    Route::put('/{id}', [TicketController::class, 'update'])->name('update');
    Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
    Route::post('/validate', [TicketController::class, 'validateTicket'])->name('validate');
    Route::get('/user/my-tickets', [TicketController::class, 'myTickets'])->name('my-tickets');
});

// Payment API Ticket routes
Route::prefix('payment')->group(function () {
    Route::post('/createpayment', [PaymentController::class, 'createPayment'])->name('createpayment');
});
