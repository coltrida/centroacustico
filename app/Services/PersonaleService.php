<?php

namespace App\Services;

use App\Models\User;

class PersonaleService
{
    public function listaPersonale()
    {
        return User::whereNot('ruolo_id', 1)->get();
    }

    public function aggiungiPersonale($userAggiungi)
    {
        User::create([
            'nome' => $userAggiungi->nome,
            'email' => $userAggiungi->email,
            'ruolo_id' => $userAggiungi->ruolo_id,
        ]);
    }

    public function deletePersonale($user)
    {
        $user->delete();
    }
}
