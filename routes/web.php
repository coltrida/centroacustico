<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('admin.home');
Route::get('/filiali', [FrontController::class, 'filiali'])->name('admin.filiali');
Route::get('/personale', [FrontController::class, 'personale'])->name('admin.personale');
Route::post('/setConfigurazione', [FrontController::class, 'setConfigurazione'])->name('setConfigurazione');
Route::post('/aggiungiFiliale', [FrontController::class, 'aggiungiFiliale'])->name('admin.aggiungiFiliale');
Route::post('/aggiungiPersonale', [FrontController::class, 'aggiungiPersonale'])->name('admin.aggiungiPersonale');
Route::get('/deletePersonale/{idUser?}', [FrontController::class, 'deletePersonale'])->name('admin.deletePersonale');
Route::get('/clienti/{idFiliale?}', [FrontController::class, 'clienti'])->name('admin.clienti');
Route::get('/associa', [FrontController::class, 'associa'])->name('admin.associa');
Route::post('/ricercaPaziente', [FrontController::class, 'ricercaPaziente'])->name('admin.ricercaPaziente');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
