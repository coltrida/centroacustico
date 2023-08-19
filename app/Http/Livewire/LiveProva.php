<?php

namespace App\Http\Livewire;

use App\Services\CategoriaService;
use App\Services\FornitoreService;
use App\Services\ListinoService;
use App\Services\ProdottiService;
use App\Services\ProvaService;
use App\Services\StatoApaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class LiveProva extends Component
{
    public $idClient;

    public $idFiliale;
    public $fornitore_id;
    public $categoria_id;
    public $listino_id;
    public $product_id;
    public $nota;
    public $listino = [];
    public $matricole = [];

    public function mount(ProvaService $provaService)
    {
        $this->idFiliale = $provaService->clientConProvePassate($this->idClient)->filiale_id;
    }

    public function selezionaFornitore(ListinoService $listinoService)
    {
        if (!$this->categoria_id){
            $this->listino = $listinoService->elencoListinoByIdFornitore($this->fornitore_id);
        } else {
            $this->listino = $listinoService->elencoListinoByIdFornitoreAndIdCategoria($this->fornitore_id, $this->categoria_id);
        }
    }

    public function selezionaCategoria(ListinoService $listinoService)
    {
        if (!$this->fornitore_id){
            $this->listino = $listinoService->elencoListinoByIdCategoria($this->categoria_id);
        } else {
            $this->listino = $listinoService->elencoListinoByIdFornitoreAndIdCategoria($this->fornitore_id, $this->categoria_id);
        }
    }

    public function selezionaListino(ProdottiService $prodottiService)
    {
        $this->matricole = $prodottiService->prodottiInMagazzinoFromIdListino($this->listino_id, $this->idFiliale);
    }

    public function inserisciInProva(ProvaService $provaService, ProdottiService $prodottiService)
    {
        $provaService->inserisciProductInProvaById($this->product_id, $this->idClient);
        $this->matricole = $prodottiService->prodottiInMagazzinoFromIdListino($this->listino_id, $this->idFiliale);
    }

    public function eliminaDaProva(ProvaService $provaService, ProdottiService $prodottiService, $idproductSelezionato)
    {
        $provaService->eliminaProductInProvaById($idproductSelezionato);
        $this->matricole = $prodottiService->prodottiInMagazzinoFromIdListino($this->listino_id, $this->idFiliale);
    }

    public function creaProva(ProvaService $provaService,
                              ProdottiService $prodottiService,
                              StatoApaService $statoApaService)
    {
        $request = new Request();
        $request->replace([
            'client_id' => $this->idClient,
            'filiale_id' => $this->idFiliale,
            'nota' => $this->nota,
        ]);
        $provaService->creaProva($request);
        $prodottiInCorsoDiProva = $prodottiService->prodottiInCorsoDiProvaByIdClient($this->idClient);
        $idStatoProvaInCorso = $statoApaService->idStatoFromNome('PROVA IN CORSO');
        $prodottiService->cambioStatoProdotti($prodottiInCorsoDiProva, $idStatoProvaInCorso);
        session()->flash('message', "Prova Crata con Successo");
    }

    public function render(FornitoreService $fornitoreService,
                           CategoriaService $categoriaService,
                           ProdottiService $prodottiService,
                           ProvaService $provaService)
    {
        return view('livewire.live-prova', [
            'prodottiInCorsoDiProva' => $prodottiService->prodottiInCorsoDiProvaByIdClient($this->idClient),
            'clientConProvePassate' => $provaService->clientConProvePassate($this->idClient),
            'fornitori' => $fornitoreService->listaFornitori(),
            'categorie' => $categoriaService->listaCategorie(),
            'listino' => $this->listino,
        ]);
    }
}
