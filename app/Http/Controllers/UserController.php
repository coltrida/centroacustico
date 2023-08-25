<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Services\FilialeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function clienti(ClienteService $clienteService, FilialeService $filialeService, $idFiliale=null)
    {
        if(Gate::denies('view-clients', $idFiliale)){
            abort(401, 'Non autorizzato');
        }

        return view('user.clienti', [
            'pazienti' => $clienteService->clientiPagination($idFiliale),
            'filialeSelezionata' => $filialeService->filialeById($idFiliale)
        ]);
    }

    public function ricercaPaziente(Request $request, ClienteService $clienteService, FilialeService $filialeService)
    {
        return view('user.clienti', [
            'pazienti' => $clienteService->ricercaPaziente($request),
            'filialeSelezionata' => $filialeService->filialeById($request->idFiliale),
            'testo' => $request->input('testoRicerca')
        ]);
    }

    public function aggiungiModificaCliente($idFiliale=null, $idClient=null)
    {
        return view('user.aggiungiModificaCliente', [
            'idFiliale' => $idFiliale,
            'idClient' => $idClient,
        ]);
    }
}
