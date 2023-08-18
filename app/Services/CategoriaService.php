<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService
{
    public function listaCategorie()
    {
        return Categoria::orderBy('nome')->get();
    }

    public function aggiungiCategoria($request)
    {
        Categoria::create($request->all());
    }
}
