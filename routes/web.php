<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('tickets')->name('tickets.')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/{id}', [TicketController::class, 'show'])->name('show');
    Route::post('/tickets', [TicketController::class, 'store'])->name('store');
    Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('update');
    Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('edit');
    Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
    Route::get('/my', [TicketController::class, 'myTickets'])->name('my-tickets');
});

Route::fallback(function(){


    return view('404');
})-> name('404');