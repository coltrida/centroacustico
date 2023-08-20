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

    public function aggiungiAppuntamento($request)
    {
        Appuntamento::create($request->all());
    }
}
