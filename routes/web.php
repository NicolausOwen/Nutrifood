<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scanner', function () {
    return view('scanner');
});

Route::prefix('tickets')->name('tickets.')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/{id}', [TicketController::class, 'show'])->name('show');
});