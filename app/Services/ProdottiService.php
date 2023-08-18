<?php

namespace App\Services;

use App\Models\Filiale;
use App\Models\Prodotto;
use App\Models\Statoapa;

class ProdottiService
{
    public function prodottiFiliale($idFiliale)
    {
        return Filiale::with(['prodotti' => function($p){
            $p->with(['stato', 'cliente', 'listino' => function($l){
                $l->with('fornitore', 'categoria');
            }]);
        }])
            ->find($idFiliale)->prodotti()->latest()->paginate(5);
    }

    public function listaProdottiInMagazzinoByidFiliale($idFiliale)
    {
        $idStatoProdottiInMagazzino = Statoapa::where('nome', 'MAGAZZINO')->first()->id;

        return Prodotto::where([
            ['filiale_id', $idFiliale],
            ['stato_id', $idStatoProdottiInMagazzino],
        ])->latest()->paginate(5, ['*'], 'magazzino');
    }

    public function listaProdottiInProvaByidFiliale($idFiliale)
    {
        $idStatoProdottiInProva = Statoapa::where('nome', 'IN PROVA')->first()->id;

        return Prodotto::where([
            ['filiale_id', $idFiliale],
            ['stato_id', $idStatoProdottiInProva],
        ])->latest()->paginate(5, ['*'], 'prova');
    }

    public function listaProdottiRichiestiByidFiliale($idFiliale)
    {
        $idStatoProdottiRichiesti = Statoapa::where('nome', 'RICHIESTO')->first()->id;

        return Prodotto::where([
            ['filiale_id', $idFiliale],
            ['stato_id', $idStatoProdottiRichiesti],
        ])->latest()->paginate(5, ['*'], 'richiesti');
    }

    public function listaProdottiInArrivoByidFiliale($idFiliale)
    {
        $idStatoProdottiInArrivo = Statoapa::where('nome', 'SPEDITO')->first()->id;

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


}
