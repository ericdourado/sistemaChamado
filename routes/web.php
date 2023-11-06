<?php

use App\Http\Controllers\cadastro;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuportfollowupController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\user;
use App\Models\suportfollowup;
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
    Route::post('/editar-ticket/{id}', [TicketController::class, 'update'])->name('ticket.update');

    Route::post('/editar-ticket/atribuir/suport/{id}', [TicketController::class, 'atribuir'])->name('ticket.atribuir');
    Route::get('/excluir-ticket/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');


    Route::get('/ticket/feedback/{id}', [SuportfollowupController::class, 'index'])->name('ticket.feedback.index');
    Route::post('/ticket/feedback', [SuportfollowupController::class, 'store'])->name('ticket.feedback.store');

    Route::get('/users', [user::class, 'index'])->name('users.index');
    Route::post('/user-cargo/{id}', [user::class, 'update'])->name('users.update');

});



//user abaixo
Route::get('/tickets-usuario', [TicketController::class, 'tickets-usuario'])->name('ticket.ticksts-usuario');

require __DIR__.'/auth.php';
