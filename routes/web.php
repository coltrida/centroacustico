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
Route::delete('/deletePersonale/{idUser}', [FrontController::class, 'deletePersonale'])->name('admin.deletePersonale');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
