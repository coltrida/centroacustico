<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Configuration;
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

    public function filialeById($idFiliale)
    {
        if ($idFiliale){
            return Filiale::find($idFiliale);
        }
        return Configuration::first()->nomeAzienda;
    }

    public function filialeByIdClient($idClient)
    {
        return Client::with('filiale')->find($idClient)->filiale;
    }
}
