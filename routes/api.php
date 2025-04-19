<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// API Ticket routes
Route::prefix('tickets')->name('api.tickets.')->group(function () {
    Route::get('/', [TicketController::class, 'indexapi'])->name('indexapi');
    Route::post('/', [TicketController::class, 'store'])->name('store');
    Route::get('/{id}', [TicketController::class, 'show'])->name('show');
    Route::put('/{id}', [TicketController::class, 'update'])->name('update');
    Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');

    Route::post('/validate', [TicketController::class, 'validateTicket'])->name('validate');
    Route::get('/user/my-tickets', [TicketController::class, 'myTickets'])->name('my-tickets');
});