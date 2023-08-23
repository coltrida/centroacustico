<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Informazione;

class InformazioneService
{
    public function inserisciInformazione($request)
    {
        Informazione::create($request->all());
    }

    public function clientConListaInformazioniByIdClient($idClient)
    {
        $client = Client::with(['informazioni' => function($i){
            $i->latest();
        }])->find($idClient);
        $client->setRelation('informazioni', $client->informazioni()->paginate(5));
        return $client;
    }
}
