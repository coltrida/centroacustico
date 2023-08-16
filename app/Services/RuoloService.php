<?php

namespace App\Services;

use App\Models\Ruolo;

class RuoloService
{
    public function listaRuoli()
    {
        return Ruolo::whereNot('id', 1)->orderBy('nome')->get();
    }

    public function aggiungiRuolo($nomeRuolo)
    {
        Ruolo::create([
            'nome' => $nomeRuolo
        ]);
    }
}
