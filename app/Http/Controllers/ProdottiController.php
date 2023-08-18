<?php

namespace App\Http\Controllers;

use App\Services\FilialeService;
use App\Services\ProdottiService;
use Illuminate\Http\Request;

class ProdottiController extends Controller
{
    public function prodottiInMagazzino(ProdottiService $prodottiService, FilialeService $filialeService, $idFiliale=null)
    {
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiInMagazzinoByidFiliale($idFiliale),
            'menu1' => 'active',
            'menu2' => '',
            'menu3' => '',
            'menu4' => '',
        ]);
    }

    public function prodottiInProva(ProdottiService $prodottiService, FilialeService $filialeService, $idFiliale=null)
    {
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiInProvaByidFiliale($idFiliale),
            'menu1' => '',
            'menu2' => 'active',
            'menu3' => '',
            'menu4' => '',
        ]);
    }

    public function prodottiRichiesti(ProdottiService $prodottiService, FilialeService $filialeService, $idFiliale=null)
    {
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiRichiestiByidFiliale($idFiliale),
            'menu1' => '',
            'menu2' => '',
            'menu3' => 'active',
            'menu4' => '',
        ]);
    }

    public function prodottiInArrivo(ProdottiService $prodottiService, FilialeService $filialeService, $idFiliale=null)
    {
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiInArrivoByidFiliale($idFiliale),
            'menu1' => '',
            'menu2' => '',
            'menu3' => '',
            'menu4' => 'active',
        ]);
    }
}
