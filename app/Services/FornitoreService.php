<?php

namespace App\Services;

use App\Models\Fornitore;

class FornitoreService
{
    public function listaFornitori()
    {
        return Fornitore::orderBy('nome')->get();
    }

    public function aggiungiFornitore($request)
    {
        Fornitore::create($request->all());
    }
}
