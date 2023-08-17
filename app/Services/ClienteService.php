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
        if ($idFiliale){
            return Filiale::with(['clienti' => function($c){
                $c->with('tipo');
            }])->find($idFiliale)->clienti()->paginate(5);
        }
        return Client::paginate(5);
    }

    public function ricercaPaziente($request)
    {
        if ($request->input('idFiliale')){
            return Client::
            where([
                ['filiale_id', $request->input('idFiliale')],
                ['nome', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])
                ->orWhere([
                    ['filiale_id', $request->input('idFiliale')],
                    ['cognome', 'like', '%' . $request->input('testoRicerca') . '%' ]
                ])->orWhere([
                    ['filiale_id', $request->input('idFiliale')],
                    ['fullName', 'like', '%' . $request->input('testoRicerca') . '%' ]
                ])->orWhere([
                    ['filiale_id', $request->input('idFiliale')],
                    ['fullNameReverse', 'like', '%' . $request->input('testoRicerca') . '%' ]
                ])
                ->paginate(50);
        }
        return Client::
            where([
                ['nome', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])
            ->orWhere([
                ['cognome', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])->orWhere([
                ['fullName', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])->orWhere([
                ['fullNameReverse', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])
            ->paginate(50);
    }
}
