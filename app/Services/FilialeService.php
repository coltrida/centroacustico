<?php

namespace App\Services;

use App\Models\Filiale;

class FilialeService
{
    public function listaFiliali()
    {
        return Filiale::orderBy('nome')->get();
    }

    public function aggiungiFiliale($request)
    {
        Filiale::create($request->all());
    }
}
