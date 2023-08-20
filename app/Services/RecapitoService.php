<?php

namespace App\Services;

use App\Models\Filiale;
use App\Models\Recapito;

class RecapitoService
{
    public function listaRecapiti()
    {
        return Recapito::with('filiale')->latest()->get();
    }

    public function aggiungiRecapito($request)
    {
        Recapito::create($request->all());
    }

    public function listaRecapitiByIdFiliale($idFiliale)
    {
        return Filiale::with('recapiti')->find($idFiliale)->recapiti;
    }
}
