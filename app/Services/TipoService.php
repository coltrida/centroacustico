<?php

namespace App\Services;

use App\Models\Tipo;

class TipoService
{
    public function listaTipologia()
    {
        return Tipo::get();
    }

    public function aggiungiTipo($request)
    {
        Tipo::create($request->all());
    }
}
