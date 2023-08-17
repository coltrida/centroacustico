<?php

namespace App\Services;

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
}
