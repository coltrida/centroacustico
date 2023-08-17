<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Services\CanaleService;
use App\Services\ConfigurationService;
use App\Services\RuoloService;
use App\Services\TipoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConfigController extends Controller
{
    public function setAnagraficaAzienda(Request $request, ConfigurationService $configurationService)
    {
        $configurationService->setConfigurazione($request);
        return Redirect::route('setRuoli');
    }

    public function setRuoli(RuoloService $ruoloService)
    {
        return view('configura.confRuoli', [
            'ruoli' => $ruoloService->listaRuoli()
        ]);
    }

    public function eseguiSetRuoli(Request $request, RuoloService $ruoloService)
    {
        $ruoloService->aggiungiRuolo($request->nome);
        return Redirect::back();
    }

    public function setTipologie(TipoService $tipoService)
    {
        return view('configura.confTipologiePazienti', [
            'tipologie' => $tipoService->listaTipologia()
        ]);
    }

    public function eseguiSetTipologie(Request $request, TipoService $tipoService)
    {
        $tipoService->aggiungiTipo($request);
        return Redirect::back();
    }

    public function setCanali(CanaleService $canaleService)
    {
        return view('configura.confCanali', [
            'canali' => $canaleService->listaCanali()
        ]);
    }

    public function eseguiSetCanali(Request $request, CanaleService $canaleService)
    {
        $canaleService->aggiungiCanale($request);
        return Redirect::back();
    }
}
