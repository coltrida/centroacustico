<?php

namespace App\Services;

use App\Models\Listino;

class ListinoService
{
    public function elencoListino()
    {
        return Listino::with('categoria', 'fornitore')
            ->orderBy('fornitore_id')
            ->orderBy('categoria_id')
            ->orderBy('nome')
            ->get();
    }

    public function aggiungiListino($request)
    {
        Listino::create($request->all());
    }
}
