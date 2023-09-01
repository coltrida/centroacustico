<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppuntamentoController;
use App\Http\Controllers\AudiometriaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InformazioniController;
use App\Http\Controllers\ProdottiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\TelefonataController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/prova', [FrontController::class, 'prova'])->name('prova');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [FrontController::class, 'index'])->name('admin.home');

    Route::group(['middleware' => ['verifyIsAdmin']], function () {
        //----------------------- Config --------------------------
        Route::post('/setAnagraficaAzienda', [ConfigController::class, 'setAnagraficaAzienda'])->name('setAnagraficaAzienda');
        Route::get('/setTipologie', [ConfigController::class, 'setTipologie'])->name('setTipologie');
        Route::post('/setTipologie', [ConfigController::class, 'eseguiSetTipologie'])->name('eseguiSetTipologie');
        Route::get('/setRuoli', [ConfigController::class, 'setRuoli'])->name('setRuoli');
        Route::post('/eseguiSetRuoli', [ConfigController::class, 'eseguiSetRuoli'])->name('eseguiSetRuoli');
        Route::get('/setCanali', [ConfigController::class, 'setCanali'])->name('setCanali');
        Route::post('/eseguiSetCanali', [ConfigController::class, 'eseguiSetCanali'])->name('eseguiSetCanali');

        //----------------------- Admin ----------------------------
        Route::get('/infoAzienda', [AdminController::class, 'infoAzienda'])->name('admin.infoAzienda');
        Route::patch('/infoAzienda', [AdminController::class, 'modificaInfoAzienda'])->name('admin.modificaInfoAzienda');
        Route::get('/filiali', [AdminController::class, 'filiali'])->name('admin.filiali');
        Route::post('/aggiungiFiliale', [AdminController::class, 'aggiungiFiliale'])->name('admin.aggiungiFiliale');
        Route::get('/fornitori', [AdminController::class, 'fornitori'])->name('admin.fornitori');
        Route::post('/aggiungiFornitore', [AdminController::class, 'aggiungiFornitore'])->name('admin.aggiungiFornitore');
        Route::get('/listino', [AdminController::class, 'listino'])->name('admin.listino');
        Route::post('/aggiungiListino', [AdminController::class, 'aggiungiListino'])->name('admin.aggiungiListino');
        Route::get('/categorie', [AdminController::class, 'categorie'])->name('admin.categorie');
        Route::post('/aggiungiCategoria', [AdminController::class, 'aggiungiCategoria'])->name('admin.aggiungiCategoria');
        Route::get('/canali', [AdminController::class, 'canali'])->name('admin.canali');
        Route::post('/aggiungiCanale', [AdminController::class, 'aggiungiCanale'])->name('admin.aggiungiCanale');
        Route::get('/eliminaCanale/{idCanale}', [AdminController::class, 'eliminaCanale'])->name('admin.eliminaCanale');
        Route::get('/ruoli', [AdminController::class, 'ruoli'])->name('admin.ruoli');
        Route::post('/aggiungiRuolo', [AdminController::class, 'aggiungiRuolo'])->name('admin.aggiungiRuolo');
        Route::get('/tipologie', [AdminController::class, 'tipologie'])->name('admin.tipologie');
        Route::post('/aggiungiTipologia', [AdminController::class, 'aggiungiTipologia'])->name('admin.aggiungiTipologia');
        Route::get('/eliminaTipologia/{idTipologia}', [AdminController::class, 'eliminaTipologia'])->name('admin.eliminaTipologia');
        Route::get('/recapiti', [AdminController::class, 'recapiti'])->name('admin.recapiti');
        Route::post('/aggiungiRecapito', [AdminController::class, 'aggiungiRecapito'])->name('admin.aggiungiRecapito');
        Route::delete('/eliminaRecapito', [AdminController::class, 'eliminaRecapito'])->name('admin.eliminaRecapito');
        Route::get('/personale', [AdminController::class, 'personale'])->name('admin.personale');
        Route::post('/aggiungiPersonale', [AdminController::class, 'aggiungiPersonale'])->name('admin.aggiungiPersonale');
        Route::get('/deletePersonale/{idUser?}', [AdminController::class, 'deletePersonale'])->name('admin.deletePersonale');
        Route::get('/associa', [AdminController::class, 'associa'])->name('admin.associa');
        Route::post('/associa', [AdminController::class, 'eseguiAssocia'])->name('admin.eseguiAssocia');
        Route::get('/eliminaAssociazione/{idAssociazione}', [AdminController::class, 'eliminaAssociazione'])->name('admin.eliminaAssociazione');
    });

//------------------------ Clienti -------------------------------
    Route::get('/clienti/{idFiliale?}', [UserController::class, 'clienti'])->name('clienti');
    Route::get('/aggiungiModificaCliente/{idFiliale?}/{idClient?}', [UserController::class, 'aggiungiModificaCliente'])->name('aggiungiModificaCliente');
    Route::get('/ricercaPaziente', [UserController::class, 'ricercaPaziente'])->name('ricercaPaziente');

//------------------------ Magazzino -------------------------------
    Route::get('/prodottiInMagazzino/{idFiliale?}', [ProdottiController::class, 'prodottiInMagazzino'])->name('magazzino');
    Route::get('/prodottiInProva/{idFiliale?}', [ProdottiController::class, 'prodottiInProva'])->name('prodottiInProva');
    Route::get('/prodottiRichiesti/{idFiliale?}', [ProdottiController::class, 'prodottiRichiesti'])->name('prodottiRichiesti');
    Route::get('/prodottiInArrivo/{idFiliale?}', [ProdottiController::class, 'prodottiInArrivo'])->name('prodottiInArrivo');
    Route::get('/switchProdottoInMagazzino/{idProdotto}', [ProdottiController::class, 'switchProdottoInMagazzino'])->name('switchProdottoInMagazzino');

//------------------------ Prova -------------------------------
    Route::get('/prova/{idClient}', [ProvaController::class, 'prova'])->name('prova');

//------------------------ Telefono -------------------------------
    Route::get('/telefonata/{idClient}', [TelefonataController::class, 'telefonata'])->name('telefonata');
    Route::post('/telefonataEffettuata', [TelefonataController::class, 'telefonataEffettuata'])->name('telefonataEffettuata');

//------------------------ Appuntamento -------------------------------
    Route::get('/appuntamenti/{idClient}', [AppuntamentoController::class, 'appuntamenti'])->name('appuntamenti');
    Route::post('/appuntamenti/aggiungi', [AppuntamentoController::class, 'aggiungi'])->name('appuntamenti.aggiungi');
    Route::patch('/appuntamenti/modifica/{id}', [AppuntamentoController::class, 'modifica'])->name('appuntamenti.modifica');
    Route::delete('/appuntamenti/elimina/{id}', [AppuntamentoController::class, 'elimina'])->name('appuntamenti.elimina');

//------------------------ Audiometrie -------------------------------
    Route::get('/audiometrie/{idClient}/{idAudiometria?}', [AudiometriaController::class, 'audiometrie'])->name('audiometrie');

//------------------------ Informazioni -------------------------------
    Route::get('/informazioni/{idClient}', [InformazioniController::class, 'informazioni'])->name('informazioni');

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
