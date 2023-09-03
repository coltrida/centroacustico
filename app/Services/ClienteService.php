<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Filiale;
use Illuminate\Support\Facades\DB;

class ClienteService
{
/*    public function filialeConClienti($idFiliale)
    {
        return Filiale::with('clienti')->find($idFiliale);
    }*/

    public function filialiConRiepilogo()
    {
        /*dd(Client::with('tipo')->select('tipo_id', DB::raw('count(*) as total'))
            ->groupBy('tipo_id')->get());*/

        /*dd(Filiale::
        withCount(['clienti as LEAD' => function($q){
            $q->whereHas('tipo', function ($z){
                $z->where('nome', 'LEAD');
            });
        }])
            ->withCount(['clienti as CL' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'CL');
                });
            }])
            ->withCount(['clienti as PC' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'PC');
                });
            }])
            ->withCount(['clienti as CLC' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'CLC');
                });
            }])
            ->withCount(['clienti as PREM' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'PREM');
                });
            }])
            ->withCount(['clienti as DEC' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'DEC');
                });
            }])
            ->withCount(['clienti as TAPPO' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'TAPPO');
                });
            }])
            ->withCount(['clienti as NORMO' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'NORMO');
                });
            }])
            ->withCount('clienti as tot')
            ->orderBy('nome')
            ->get());*/

        return Filiale::
        withCount(['clienti as LEAD' => function($q){
            $q->whereHas('tipo', function ($z){
                $z->where('nome', 'LEAD');
            });
        }])
            ->withCount(['clienti as CL' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'CL');
                });
            }])
            ->withCount(['clienti as PC' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'PC');
                });
            }])
            ->withCount(['clienti as CLC' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'CLC');
                });
            }])
            ->withCount(['clienti as PREM' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'PREM');
                });
            }])
            ->withCount(['clienti as DEC' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'DEC');
                });
            }])
            ->withCount(['clienti as TAPPO' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'TAPPO');
                });
            }])
            ->withCount(['clienti as NORMO' => function($q){
                $q->whereHas('tipo', function ($z){
                    $z->where('nome', 'NORMO');
                });
            }])
            ->withCount('clienti as tot')
            ->orderBy('nome')
            ->get();
    }

    public function clientiPagination($idFiliale)
    {
        if ($idFiliale){
            return Filiale::with(['clienti' => function($c){
                $c->with('tipo', 'canale', 'recapito');
            }])->find($idFiliale)->clienti()->latest()->paginate(5);
        }
        return Client::paginate(5);
    }

    public function ricercaPaziente($request)
    {
        if ($request->input('idFiliale')){
            return Client::with('tipo', 'canale', 'recapito')
            ->where([
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
                ])->latest()
                ->paginate(50);
        }
        return Client::with('tipo', 'canale', 'recapito')
            ->where([
                ['nome', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])
            ->orWhere([
                ['cognome', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])->orWhere([
                ['fullName', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])->orWhere([
                ['fullNameReverse', 'like', '%' . $request->input('testoRicerca') . '%' ]
            ])->latest()
            ->paginate(50);
    }

    public function ricercaPazienteById($idClient)
    {
        return Client::with('tipo', 'canale', 'recapito')
            ->where('id', $idClient)->paginate(50);
    }

    public function clientById($idClient)
    {
        return Client::with('tipo', 'canale')->find($idClient);
    }

    public function inserisciCliente($request)
    {
        Client::create($request->request->all());
    }

    public function modificaCliente($idClient, $request)
    {
        Client::find($idClient)->update($request->request->all());
    }
}
