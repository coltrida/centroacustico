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
Route::get('/setCanali', [ConfigController::class, 'setCanali'])->name('setCanali');
Route::post('/eseguiSetCanali', [ConfigController::class, 'eseguiSetCanali'])->name('eseguiSetCanali');

//----------------------- Admin ----------------------------
Route::get('/filiali', [AdminController::class, 'filiali'])->name('admin.filiali');
Route::post('/aggiungiFiliale', [AdminController::class, 'aggiungiFiliale'])->name('admin.aggiungiFiliale');
Route::get('/recapiti', [AdminController::class, 'recapiti'])->name('admin.recapiti');
Route::post('/aggiungiRecapito', [AdminController::class, 'aggiungiRecapito'])->name('admin.aggiungiRecapito');
Route::get('/personale', [AdminController::class, 'personale'])->name('admin.personale');
Route::post('/aggiungiPersonale', [AdminController::class, 'aggiungiPersonale'])->name('admin.aggiungiPersonale');
Route::get('/deletePersonale/{idUser?}', [AdminController::class, 'deletePersonale'])->name('admin.deletePersonale');
Route::get('/associa', [AdminController::class, 'associa'])->name('admin.associa');
Route::post('/associa', [AdminController::class, 'eseguiAssocia'])->name('admin.eseguiAssocia');
Route::get('/eliminaAssociazione/{idAssociazione}', [AdminController::class, 'eliminaAssociazione'])->name('admin.eliminaAssociazione');

//------------------------ User -------------------------------
Route::get('/clienti/{idFiliale?}', [UserController::class, 'clienti'])->name('clienti');
Route::get('/aggiungiModificaCliente/{idFiliale?}/{idClient?}', [UserController::class, 'aggiungiModificaCliente'])->name('aggiungiModificaCliente');
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
