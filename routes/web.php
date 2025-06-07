<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TicketController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/ticket', [TicketController::class, 'dashboard2'])->middleware(['auth', 'verified'])->name('dashboard2');

Route::get('/cek-email', function () {
    return env('MAIL_FROM_ADDRESS');
});

require __DIR__.'/auth.php';

Route::fallback(function(){
    return view('404');
})-> name('404');
