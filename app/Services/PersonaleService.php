<?php

namespace App\Services;

use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PersonaleService
{
    public function listaPersonale()
    {
        return User::with('ruolo')->whereNot('ruolo_id', 1)->get();
    }

    public function aggiungiPersonale($userAggiungi)
    {
        User::create([
            'nome' => $userAggiungi->nome,
            'email' => $userAggiungi->email,
            'ruolo_id' => $userAggiungi->ruolo_id,
            'password' => Hash::make('123456'),
        ]);
    }

    public function deletePersonale($userId)
    {
        User::find($userId)->delete();
    }

    public function associaFiliale($request)
    {
        $filiale = Filiale::find($request->filiale_id);
        $filiale->users()->attach($request->users);
    }

    public function eliminaAssociazione($idAssociazione)
    {
        FilialeUser::find($idAssociazione)->delete();
    }
}
