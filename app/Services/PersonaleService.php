<?php

namespace App\Services;

use App\Models\User;

class PersonaleService
{
    public function listaPersonale()
    {
        return User::whereNot('ruolo_id', 1)->get();
    }

    public function aggiungiPersonale($request)
    {
        User::create($request->all());
    }

    public function deletePersonale($idUser)
    {
        User::find($idUser)->delete();
    }
}
