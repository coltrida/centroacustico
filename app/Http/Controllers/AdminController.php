<?php

namespace App\Http\Controllers;

use App\Services\FilialeService;
use App\Services\PersonaleService;
use App\Services\RecapitoService;
use App\Services\RuoloService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function filiali()
    {
        return view('admin.filiali');
    }

    public function aggiungiFiliale(Request $request, FilialeService $filialeService)
    {
        $filialeService->aggiungiFiliale($request);
        return Redirect::route('admin.filiali');
    }

    public function recapiti(RecapitoService $recapitoService)
    {
        return view('admin.recapiti', [
            'recapiti' => $recapitoService->listaRecapiti()
        ]);
    }

    public function aggiungiRecapito(Request $request, RecapitoService $recapitoService)
    {
        $recapitoService->aggiungiRecapito($request);
        return Redirect::back();
    }

    public function aggiungiPersonale(Request $request, PersonaleService $personaleService)
    {
        $personaleService->aggiungiPersonale($request);
        return Redirect::route('admin.personale');
    }

    public function deletePersonale($idUser, PersonaleService $personaleService)
    {
        $personaleService->deletePersonale($idUser);
        return Redirect::route('admin.personale');
    }

    public function personale(PersonaleService $personaleService, RuoloService $ruoloService)
    {
        return view('admin.personale', [
            'personale' => $personaleService->listaPersonale(),
            'ruoli' => $ruoloService->listaRuoli()
        ]);
    }

    public function associa(PersonaleService $personaleService)
    {
        return view('admin.associa', [
            'personale' => $personaleService->listaPersonale(),
        ]);
    }

    public function eseguiAssocia(Request $request, PersonaleService $personaleService)
    {
        $personaleService->associaFiliale($request);
        return Redirect::back();
    }

    public function eliminaAssociazione($idAssociazione, PersonaleService $personaleService)
    {
        $personaleService->eliminaAssociazione($idAssociazione);
        return Redirect::back();
    }
}
