<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\Fornitore;
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

    public function elencoListinoByIdFornitore($idFornitore)
    {
        return Fornitore::with('listino')->find($idFornitore)->listino;
    }

    public function elencoListinoByIdFornitoreAndIdCategoria($idFornitore, $idCategoria)
    {
        return Fornitore::with(['listino' => function($l) use($idCategoria){
            $l->where('categoria_id', $idCategoria);
        }])->find($idFornitore)->listino;
    }

    public function elencoListinoByIdCategoria($idCategoria)
    {
        return Categoria::with('listino')->find($idCategoria)->listino;
    }

    public function aggiungiListino($request)
    {
        Listino::create($request->all());
    }
}
