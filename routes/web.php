<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('admin.home');

//----------------------- Config --------------------------
Route::post('/setAnagraficaAzienda', [ConfigController::class, 'setAnagraficaAzienda'])->name('setAnagraficaAzienda');
Route::get('/setTipologie', [ConfigController::class, 'setTipologie'])->name('setTipologie');
Route::post('/setTipologie', [ConfigController::class, 'eseguiSetTipologie'])->name('eseguiSetTipologie');
Route::get('/setRuoli', [ConfigController::class, 'setRuoli'])->name('setRuoli');
Route::post('/eseguiSetRuoli', [ConfigController::class, 'eseguiSetRuoli'])->name('eseguiSetRuoli');

//----------------------- Admin ----------------------------
Route::get('/filiali', [AdminController::class, 'filiali'])->name('admin.filiali');
Route::post('/aggiungiFiliale', [AdminController::class, 'aggiungiFiliale'])->name('admin.aggiungiFiliale');
Route::get('/personale', [AdminController::class, 'personale'])->name('admin.personale');
Route::post('/aggiungiPersonale', [AdminController::class, 'aggiungiPersonale'])->name('admin.aggiungiPersonale');
Route::get('/deletePersonale/{idUser?}', [AdminController::class, 'deletePersonale'])->name('admin.deletePersonale');
Route::get('/associa', [AdminController::class, 'associa'])->name('admin.associa');
Route::post('/associa', [AdminController::class, 'eseguiAssocia'])->name('admin.eseguiAssocia');
Route::get('/eliminaAssociazione/{idAssociazione}', [AdminController::class, 'eliminaAssociazione'])->name('admin.eliminaAssociazione');

//------------------------ User -------------------------------
Route::get('/clienti/{idFiliale?}', [UserController::class, 'clienti'])->name('clienti');
Route::get('/aggiungiCliente/{idFiliale}', [UserController::class, 'aggiungiCliente'])->name('aggiungiCliente');
Route::get('/ricercaPaziente', [UserController::class, 'ricercaPaziente'])->name('ricercaPaziente');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
