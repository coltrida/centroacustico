<?php

namespace App\Services;

use App\Models\Client;

class AudiometriaService
{
    public function clientConAudiometrieByIdClient($idClient)
    {
        return Client::with(['audiometrie' => function($a){
            $a->latest();
        }])->find($idClient);
    }
}
