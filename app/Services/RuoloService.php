<?php

namespace App\Services;

use App\Models\Ruolo;

class RuoloService
{
    public function listaRuoli()
    {
        return Ruolo::whereNot('nome', 'Admin')->orderBy('nome')->get();
    }

    public function aggiungiRuolo($nomeRuolo)
    {
        Ruolo::create([
            'nome' => $nomeRuolo
        ]);
    }
}
