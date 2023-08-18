<?php

namespace App\Http\Controllers;

use App\Services\CanaleService;
use App\Services\CategoriaService;
use App\Services\FilialeService;
use App\Services\FornitoreService;
use App\Services\ListinoService;
use App\Services\PersonaleService;
use App\Services\RecapitoService;
use App\Services\RuoloService;
use App\Services\TipoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function filiali()
    {
        return view('admin.filiali');
    }

    public function aggiungiFiliale(Request $request, FilialeService $filialeService)
    {
        $filialeService->aggiungiFiliale($request);
        return Redirect::route('admin.filiali');
    }

    public function recapiti(RecapitoService $recapitoService)
    {
        return view('admin.recapiti', [
            'recapiti' => $recapitoService->listaRecapiti()
        ]);
    }

    public function aggiungiRecapito(Request $request, RecapitoService $recapitoService)
    {
        $recapitoService->aggiungiRecapito($request);
        return Redirect::back();
    }

    public function aggiungiPersonale(Request $request, PersonaleService $personaleService)
    {
        $personaleService->aggiungiPersonale($request);
        return Redirect::route('admin.personale');
    }

    public function deletePersonale($idUser, PersonaleService $personaleService)
    {
        $personaleService->deletePersonale($idUser);
        return Redirect::route('admin.personale');
    }

    public function personale(PersonaleService $personaleService, RuoloService $ruoloService)
    {
        return view('admin.personale', [
            'personale' => $personaleService->listaPersonale(),
            'ruoli' => $ruoloService->listaRuoli()
        ]);
    }

    public function associa(PersonaleService $personaleService)
    {
        return view('admin.associa', [
            'personale' => $personaleService->listaPersonale(),
        ]);
    }

    public function eseguiAssocia(Request $request, PersonaleService $personaleService)
    {
        $personaleService->associaFiliale($request);
        return Redirect::back();
    }

    public function eliminaAssociazione($idAssociazione, PersonaleService $personaleService)
    {
        $personaleService->eliminaAssociazione($idAssociazione);
        return Redirect::back();
    }

    public function fornitori(FornitoreService $fornitoreService)
    {
        return view('admin.fornitori', [
            'fornitori' => $fornitoreService->listaFornitori()
        ]);
    }

    public function aggiungiFornitore(Request $request, FornitoreService $fornitoreService)
    {
        $fornitoreService->aggiungiFornitore($request);
        return Redirect::back();
    }

    public function listino(ListinoService $listinoService,
                            FornitoreService $fornitoreService,
                            CategoriaService $categoriaService)
    {
        return view('admin.listino', [
            'listino' => $listinoService->elencoListino(),
            'fornitori' => $fornitoreService->listaFornitori(),
            'categorie' => $categoriaService->listaCategorie(),
        ]);
    }

    public function aggiungiListino(Request $request, ListinoService $listinoService)
    {
        $listinoService->aggiungiListino($request);
        return Redirect::back();
    }

    public function categorie(CategoriaService $categoriaService)
    {
        return view('admin.categorie', [
            'categorie' => $categoriaService->listaCategorie()
        ]);
    }

    public function aggiungiCategoria(Request $request, CategoriaService $categoriaService)
    {
        $categoriaService->aggiungiCategoria($request);
        return Redirect::back();
    }

    public function canali(CanaleService $canaleService)
    {
        return view('admin.canali', [
            'canali' => $canaleService->listaCanali()
        ]);
    }

    public function aggiungiCanale(Request $request, CanaleService $canaleService)
    {
        $canaleService->aggiungiCanale($request);
        return Redirect::back();
    }

    public function ruoli(RuoloService $ruoloService)
    {
        return view('admin.ruoli', [
            'ruoli' => $ruoloService->listaRuoli()
        ]);
    }

    public function aggiungiRuolo(Request $request, RuoloService $ruoloService)
    {
        $ruoloService->aggiungiRuolo($request->nome);
        return Redirect::back();
    }

    public function tipologie(TipoService $tipoService)
    {
        return view('admin.tipologie', [
            'tipologie' => $tipoService->listaTipologia()
        ]);
    }

    public function aggiungiTipologia(Request $request, TipoService $tipoService)
    {
        $tipoService->aggiungiTipo($request);
        return Redirect::back();
    }
}
