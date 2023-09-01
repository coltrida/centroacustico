<?php

namespace App\Services;

use App\Models\Appuntamento;
use App\Models\User;

class AppuntamentoService
{
    public function userConAppuntamentiSettimanaByIdUser($idUser, $settimana, $anno)
    {
     //   dd($idClient.' '.$settimana.' '.$anno);
        return User::with(['appuntamenti' => function($a) use($settimana, $anno){
            $a->where([
                ['settimana', $settimana],
                ['anno', $anno],
            ]);
        }])->find($idUser);
    }

    public function appuntamentiByIdUser($idUser)
    {
          /*dd(User::with(['appuntamenti' => function($a){
                   $a->with('client');
                }])->find($idUser)->appuntamenti);*/
        return User::with(['appuntamenti' => function($a){
            $a->with('client');
        }])->find($idUser)->appuntamenti;
    }

    public function aggiungiAppuntamento($request)
    {
        return Appuntamento::create([
            'tipo' => $request->tipo,
            'user_id' => $request->user_id,
            'nota' => $request->nota,
            'client_id' => $request->idClient,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }

    public function aggiornaEsitoAppuntamento($idAppuntamento, $valoreEsito)
    {
        Appuntamento::find($idAppuntamento)->update([
           'intervenuto' => $valoreEsito
        ]);
    }

    public function eliminaAppuntamento($idAppuntamento)
    {
        Appuntamento::find($idAppuntamento)->delete();
    }

    public function AggiornaOrario($id, $request)
    {
        $booking = Appuntamento::find($id);
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }
}
