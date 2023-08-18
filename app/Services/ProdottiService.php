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

    public function listaProdottiInMagazzinoByidFiliale($idFiliale)
    {
        $idStatoProdottiInMagazzino = Statoapa::where('nome', 'MAGAZZINO')->first()->id;
        return Filiale::with(['prodotti' => function($p) use($idStatoProdottiInMagazzino){
            $p->where('stato_id', $idStatoProdottiInMagazzino);
        }])
            ->find($idFiliale)->prodotti;
    }
}
