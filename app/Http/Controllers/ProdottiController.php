<?php

namespace App\Http\Controllers;

use App\Services\FilialeService;
use App\Services\ProdottiService;
use App\Services\StatoApaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProdottiController extends Controller
{
    public function prodottiInMagazzino(ProdottiService $prodottiService,
                                        FilialeService $filialeService,
                                        StatoApaService $statoApaService,
                                        $idFiliale=null)
    {
        $idApaInMagazzino = $statoApaService->idStatoFromNome('MAGAZZINO');
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiInMagazzinoByidFiliale($idFiliale, $idApaInMagazzino),
            'menu1' => 'active',
            'menu2' => '',
            'menu3' => '',
            'menu4' => '',
        ]);
    }

    public function prodottiInProva(ProdottiService $prodottiService,
                                    FilialeService $filialeService,
                                    StatoApaService $statoApaService,
                                    $idFiliale=null)
    {
        $idApaInProva = $statoApaService->idStatoFromNome('PROVA IN CORSO');
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiInProvaByidFiliale($idFiliale, $idApaInProva),
            'menu1' => '',
            'menu2' => 'active',
            'menu3' => '',
            'menu4' => '',
        ]);
    }

    public function prodottiRichiesti(ProdottiService $prodottiService,
                                      FilialeService $filialeService,
                                      StatoApaService $statoApaService,
                                      $idFiliale=null)
    {
        $idApaRichiesti = $statoApaService->idStatoFromNome('RICHIESTO');
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiRichiestiByidFiliale($idFiliale, $idApaRichiesti),
            'menu1' => '',
            'menu2' => '',
            'menu3' => 'active',
            'menu4' => '',
        ]);
    }

    public function prodottiInArrivo(ProdottiService $prodottiService,
                                     FilialeService $filialeService,
                                     StatoApaService $statoApaService,
                                     $idFiliale=null)
    {
        $idApaInArrivo = $statoApaService->idStatoFromNome('SPEDITO');
        return view('user.magazzino', [
            'idFiliale' => $idFiliale,
            'filiale' => $filialeService->filialeById($idFiliale),
            'prodotti' => $prodottiService->listaProdottiInArrivoByidFiliale($idFiliale, $idApaInArrivo),
            'menu1' => '',
            'menu2' => '',
            'menu3' => '',
            'menu4' => 'active',
        ]);
    }

    public function switchProdottoInMagazzino($idProdotto, ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $idApaInMagazzino = $statoApaService->idStatoFromNome('MAGAZZINO');
        $prodottiService->switchProdottoInMagazzino($idProdotto, $idApaInMagazzino);
        return Redirect::back();
    }
}
