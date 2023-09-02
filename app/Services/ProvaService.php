<?php

namespace App\Services;

use App\Events\NuovaProvaFatturataEvent;
use App\Events\NuovaProvaInCorsoEvent;
use App\Models\Client;
use App\Models\Prodotto;
use App\Models\Prova;
use App\Models\Statoapa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProvaService
{
    public function clientConProvePassate($idClient)
    {
        return Client::with(['filiale', 'prove' => function($e){
            $e->orderBy('created_at')->with(['canale', 'prodotti' => function($p){
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
        $prova = Prova::create([
           'user_id' => Auth::id(),
           'client_id' => $request->client_id,
           'filiale_id' => $request->filiale_id,
           'stato_id' => $idStatoProvaInCorso,
           'tot' => $request->tot,
           'nota' => $request->nota,
           'canale_id' => $request->canale_id,
           'inizio_prova' => Carbon::now(),
        ]);
        broadcast(new NuovaProvaInCorsoEvent())->toOthers();
        return $prova->id;
    }

    public function resoProva($idProva, $idStatoReso)
    {
        $prova = Prova::find($idProva);
        $prova->stato_id = $idStatoReso;
        $prova->fine_prova = Carbon::now();
        $prova->save();
    }

    public function proformaProva($idProva, $idStatoFattura)
    {
        $prova = Prova::find($idProva);
        $prova->stato_id = $idStatoFattura;
        $prova->fine_prova = Carbon::now();
        $prova->mese_fine = Carbon::now()->month;
        $prova->anno_fine = Carbon::now()->year;
        $prova->giorni_prova = Carbon::now()->diff($prova->fine_prova)->days;
        $prova->save();

        broadcast(new NuovaProvaFatturataEvent())->toOthers();
    }

    public function dettagliProva($idProva)
    {
        return Prova::with(['canale', 'prodotti' => function($p){
            $p->with('listino');
        }])->find($idProva);
    }

    public function proveInCorso($idProveInCorso)
    {
        return Prova::with('user', 'client')
            ->where('stato_id', $idProveInCorso)
            ->paginate(5);
    }

    public function proveFatturate($idProveFatturate)
    {
        /*dd(Prova::with('user', 'client')
            ->where('stato_id', $idProveFatturate)
            ->get()->groupBy('user_id'));*/

        return Prova::with('user', 'client')
            ->where('stato_id', $idProveFatturate)
            ->get()->groupBy('user_id');
    }
}
