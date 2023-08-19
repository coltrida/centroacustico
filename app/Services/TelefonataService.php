<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Telefonata;

class TelefonataService
{
    public function userConTelefonate($idClient)
    {
        $client = Client::with(['telefonate' => function($t){
            $t->paginate(5);
        }])->find($idClient);

        $client->setRelation('telefonate', $client->telefonate()->paginate(5));

        return $client;
    }

    public function salvaTelefonata($request)
    {
        Telefonata::create([
            'client_id' => $request->client_id,
            'esito' => $request->esito,
            'note' => $request->note,
            'effettuata' => 1,
        ]);
    }
}
