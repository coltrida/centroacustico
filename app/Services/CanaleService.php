<?php

namespace App\Services;

use App\Models\Canale;

class CanaleService
{
    public function listaCanali()
    {
        return Canale::orderBy('nome')->get();
    }

    public function aggiungiCanale($request)
    {
        Canale::create($request->all());
    }
}
