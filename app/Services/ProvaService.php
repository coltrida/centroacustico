<?php

namespace App\Services;

use App\Models\Client;

class ProvaService
{
    public function clientConProvePassate($idClient)
    {
        return Client::with(['prove' => function($p){
            $p->with(['canale', 'prodotti' => function($p){
                $p->with('listino');
            }]);
        }])->find($idClient);
    }
}
