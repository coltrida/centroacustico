<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Services\ConfigurationService;
use App\Services\FilialeService;
use App\Services\PersonaleService;
use App\Services\RuoloService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function filiali(FilialeService $filialeService)
    {
        return view('admin.filiali', [
           'filiali' => $filialeService->listaFiliali()
        ]);
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
        /*return view('admin.personale', [
            'personale' => $personaleService->listaPersonale(),
            'ruoli' => $ruoloService->listaRuoli()
        ]);*/

        return view('admin.personale');
    }
}
