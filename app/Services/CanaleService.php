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
        return Canale::create($request->all());
    }

    public function eliminaCanale($idCanale)
    {
        $canale = Canale::find($idCanale);
        $canale->delete();
        return $canale;
    }
}
