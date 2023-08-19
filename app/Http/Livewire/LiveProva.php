<?php

namespace App\Http\Livewire;

use App\Services\CategoriaService;
use App\Services\FornitoreService;
use App\Services\ListinoService;
use App\Services\ProdottiService;
use App\Services\ProvaService;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class LiveProva extends Component
{
    public $idClient;

    public $clientConProvePassate;
    public $idFiliale;
    public $fornitore_id;
    public $categoria_id;
    public $listino_id;
    public $product_id;
    public $listino = [];
    public $matricole = [];

    public function mount(ProvaService $provaService)
    {
        $this->clientConProvePassate = $provaService->clientConProvePassate($this->idClient);
        $this->idFiliale = $this->clientConProvePassate->filiale_id;
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

    public function creaProva()
    {

        session()->flash('message', "Prova Crata con Successo");
    }

    public function render(FornitoreService $fornitoreService,
                           CategoriaService $categoriaService,
                           ProvaService $provaService)
    {
        return view('livewire.live-prova', [
            'clientConProvePassate' => $provaService->clientConProvePassate($this->idClient),
            'proveInCorso' => $provaService->proveInCorsoByIdClient($this->idClient),
            'fornitori' => $fornitoreService->listaFornitori(),
            'categorie' => $categoriaService->listaCategorie(),
            'listino' => $this->listino,
        ]);
    }
}
