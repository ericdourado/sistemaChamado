<?php

use App\Http\Controllers\cadastro;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Models\ticket;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cadastro', [cadastro::class, 'create'])->name('cadastro.create');


    
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/criar-ticket', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/criar-ticket', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/editar-ticket/{id}', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::get('/excluir-ticket/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');
});



//user abaixo
Route::get('/tickets-usuario', [TicketController::class, 'tickets-usuario'])->name('ticket.ticksts-usuario');

require __DIR__.'/auth.php';
