<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Services\FilialeService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function clienti(ClienteService $clienteService, FilialeService $filialeService, $idFiliale=null)
    {
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
