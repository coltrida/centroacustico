<?php

namespace App\Http\Controllers;

use App\Services\InformazioneService;
use Illuminate\Http\Request;

class InformazioniController extends Controller
{
    public function informazioni($idClient, InformazioneService $informazioneService)
    {
        return view('user.informazioni', [
            'clientConListaInformazioniByIdClient' => $informazioneService->clientConListaInformazioniByIdClient($idClient)
        ]);
    }
}
