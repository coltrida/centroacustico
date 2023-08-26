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
        return Tipo::create($request->all());
    }

    public function eliminaTipo($idTipologia)
    {
        $tipo = Tipo::find($idTipologia);
        $tipo->delete();
        return $tipo;
    }
}
