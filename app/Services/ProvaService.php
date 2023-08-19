<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Prodotto;
use App\Models\Prova;
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

    public function inserisciProductInProvaById($idProduct, $idClient)
    {
        $idStatoProdottiInProva = Statoapa::where('nome', 'IN PROVA')->first()->id;

        $prodotto = Prodotto::find($idProduct);
        $prodotto->stato_id = $idStatoProdottiInProva;
        $prodotto->client_id = $idClient;
        $prodotto->save();
    }

    public function eliminaProductInProvaById($idProduct)
    {
        $idStatoProdottiInMagazzino = Statoapa::where('nome', 'MAGAZZINO')->first()->id;

        $prodotto = Prodotto::find($idProduct);
        $prodotto->stato_id = $idStatoProdottiInMagazzino;
        $prodotto->client_id = null;
        $prodotto->save();
    }

    public function creaProva($request)
    {
        $idStatoProvaInCorso = Statoapa::where('nome', 'PROVA IN CORSO')->first()->id;

        Prova::create([
           'user_id' => 1,
           'client_id' => $request->client_id,
           'filiale_id' => $request->filiale_id,
           'stato_id' => $idStatoProvaInCorso,
           'nota' => $request->nota,
        ]);
    }
}
