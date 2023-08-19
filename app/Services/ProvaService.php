<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Prodotto;
use App\Models\Statoapa;

class ProvaService
{
    public function clientConProvePassate($idClient)
    {
        return Client::with(['filiale', 'prove' => function($e){
            $e->with(['canale', 'prodotti' => function($p){
                $p->with('listino');
            }]);
        }])->find($idClient);
    }

    public function proveInCorsoByIdClient($idClient)
    {
        $idStatoProdottiInProva = Statoapa::where('nome', 'IN PROVA')->first()->id;

        return Client::with(['prodotti' => function($p) use($idStatoProdottiInProva){
            $p->where('stato_id', $idStatoProdottiInProva)->with('listino');
        }])->find($idClient)->prodotti;
    }

    public function inserisciProductInProvaById($idProduct, $idClient)
    {
        $idStatoProdottiInProva = Statoapa::where('nome', 'IN PROVA')->first()->id;

        $prodotto = Prodotto::find($idProduct);
        $prodotto->stato_id = $idStatoProdottiInProva;
        $prodotto->client_id = $idClient;
        $prodotto->save();
    }
}
