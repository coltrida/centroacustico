<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Tipo;
use App\Services\ClienteService;
use App\Services\ConfigurationService;
use App\Services\FilialeService;
use App\Services\PersonaleService;
use App\Services\RuoloService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Util\Json;

class FrontController extends Controller
{
    public function index()
    {
        if (Configuration::all()->count() > 0){
            return view('admin.home');
        }
        return view('configura.confAzienda');
    }

    public function setConfigurazione(Request $request, ConfigurationService $configurationService)
    {
        $configurationService->setConfigurazione($request);
        return view('configura.confRuoli');
    }

    public function setTipologie()
    {
        return view('configura.confTipologiePazienti', [
            'tipologie' => Tipo::latest()->get()
        ]);
    }

    public function eseguiSetTipologie(Request $request, ConfigurationService $configurationService)
    {
        $configurationService->setTipologie($request);
        return Redirect::back();
    }

    public function filiali(FilialeService $filialeService)
    {
        return view('admin.filiali');
    }

    public function aggiungiFiliale(Request $request, FilialeService $filialeService)
    {
        $filialeService->aggiungiFiliale($request);
        return Redirect::route('admin.filiali');
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

      //  return view('admin.personale');
    }

    public function clienti(ClienteService $clienteService, FilialeService $filialeService, $idFiliale=null)
    {
        return view('admin.clienti', [
            'pazienti' => $clienteService->clientiPagination($idFiliale),
            'filialeSelezionata' => $filialeService->filialeById($idFiliale)
        ]);
    }

    public function associa(PersonaleService $personaleService)
    {
        return view('admin.associa', [
            'personale' => $personaleService->listaPersonale(),
        ]);
    }

    public function ricercaPaziente(Request $request, ClienteService $clienteService, FilialeService $filialeService)
    {
        return view('admin.clienti', [
            'pazienti' => $clienteService->ricercaPaziente($request),
            'filialeSelezionata' => $filialeService->filialeById($request->idFiliale),
            'testo' => $request->input('testoRicerca')
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
