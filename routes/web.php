<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TicketController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::fallback(function(){
    return view('404');
})-> name('404');
