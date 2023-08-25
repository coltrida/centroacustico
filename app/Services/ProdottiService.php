<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Filiale;
use App\Models\Prodotto;
use App\Models\Statoapa;
use Carbon\Carbon;

class ProdottiService
{
    /*public function prodottiFiliale($idFiliale)
    {
        return Filiale::with(['prodotti' => function($p){
            $p->with(['stato', 'cliente', 'listino' => function($l){
                $l->with('fornitore', 'categoria');
            }]);
        }])
            ->find($idFiliale)->prodotti()->latest()->paginate(5);
    }*/

    public function listaProdottiInMagazzinoByidFiliale($idFiliale, $idStatoProdottiInMagazzino)
    {
        return Prodotto::where([
            ['filiale_id', $idFiliale],
            ['stato_id', $idStatoProdottiInMagazzino],
        ])->orderBy('datacarico')->paginate(5, ['*'], 'magazzino');
    }

    public function listaProdottiInProvaByidFiliale($idFiliale, $idStatoProdottiInProva)
    {
        return Prodotto::where([
            ['filiale_id', $idFiliale],
            ['stato_id', $idStatoProdottiInProva],
        ])->latest()->paginate(5, ['*'], 'prova');
    }

    public function listaProdottiRichiestiByidFiliale($idFiliale, $idStatoProdottiRichiesti)
    {
        return Prodotto::where([
            ['filiale_id', $idFiliale],
            ['stato_id', $idStatoProdottiRichiesti],
        ])->latest()->paginate(5, ['*'], 'richiesti');
    }

    public function listaProdottiInArrivoByidFiliale($idFiliale, $idStatoProdottiInArrivo)
    {
        return Prodotto::where([
            ['filiale_id', $idFiliale],
            ['stato_id', $idStatoProdottiInArrivo],
        ])->latest()->paginate(5, ['*'], 'arrivo');
    }

    public function richiediProdottoFromFiliale($request)
    {
        $idStatoProdottoRichiesto = Statoapa::where('nome', 'RICHIESTO')->first()->id;
        for ($i=0; $i < $request->quantita; $i++){
            Prodotto::create([
               'stato_id' => $idStatoProdottoRichiesto,
               'filiale_id' => $request->filiale_id,
               'listino_id' => $request->listino_id,
            ]);
        }
    }

    public function prodottiInMagazzinoFromIdListino($idListino, $idFiliale)
    {
        $idStatoProdottiInMagazzino = Statoapa::where('nome', 'MAGAZZINO')->first()->id;
        return Prodotto::with('listino')->where([
            ['stato_id', $idStatoProdottiInMagazzino],
            ['filiale_id', $idFiliale],
            ['listino_id', $idListino],
        ])->get();
    }

    public function prodottiInCorsoDiProvaByIdClient($idClient)
    {
        $idStatoProdottiInProva = Statoapa::where('nome', 'IN PROVA')->first()->id;

        return Client::with(['prodotti' => function($p) use($idStatoProdottiInProva){
            $p->where('stato_id', $idStatoProdottiInProva)->with('listino');
        }])->find($idClient)->prodotti;
    }

    public function cambioStatoProdotti($prodotti, $id)
    {
        foreach ($prodotti as $prodotto){
            $prodotto->stato_id = $id;
            $prodotto->save();
        }
    }

    public function assegnaIdProvaAlProdotto($prodotti, $idProva)
    {
        foreach ($prodotti as $prodotto){
            $prodotto->prova_id = $idProva;
            $prodotto->save();
        }
    }

    public function importoTotaleProdottiInCorsoDiProva($idClient, $idInCorsoDiProva)
    {
        return Client::with(['prodotti' => function($p) use($idInCorsoDiProva){
            $p->where('stato_id', $idInCorsoDiProva)->with('listino');
        }])->find($idClient)->prodotti->sum('listino.prezzolistino');
    }

    public function switchProdottoInMagazzino($idProdotto, $idApaInMagazzino)
    {
        Prodotto::where('id', $idProdotto)->update([
            'stato_id' => $idApaInMagazzino,
            'datacarico' => Carbon::now(),
        ]);
    }
}
