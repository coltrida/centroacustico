<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Filiale;

class ClienteService
{
    public function filialeConClienti($idFiliale)
    {
        return Filiale::with('clienti')->find($idFiliale);
    }

    public function clientiPagination($idFiliale)
    {
        return Filiale::with('clienti')->find($idFiliale)->clienti()->paginate(5);
    }

    public function ricercaPaziente($request)
    {
        return Client::where([
            ['filiale_id', $request->input('idFiliale')],
            ['nome', 'like', '%' . $request->input('testoRicerca') . '%' ]
        ])->paginate(5);
    }
}
