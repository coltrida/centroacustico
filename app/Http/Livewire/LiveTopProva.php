<?php

namespace App\Http\Livewire;

use App\Services\CategoriaService;
use App\Services\FornitoreService;
use App\Services\ListinoService;
use App\Services\ProdottiService;
use App\Services\ProvaService;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class LiveTopProva extends Component
{
    public $idClient;
    public $idFiliale;

    public $fornitore_id;
    public $categoria_id;
    public $listino_id;
    public $product_id;
    public $listino = [];
    public $matricole = [];

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
       // dd($this->listino_id. ' ' .$this->idFiliale);
        $this->matricole = $prodottiService->prodottiInMagazzinoFromIdListino($this->listino_id, $this->idFiliale);
    }

    public function inserisciInProva(ProvaService $provaService)
    {
        $provaService->inserisciProductInProvaById($this->product_id, $this->idClient);

/*        $this->fornitore_id = '';
        $this->categoria_id = '';
        $this->listino_id = '';
        $this->quantita = '';*/

       // session()->flash('message', "Prodotto inserito");

        return Redirect::route('prova', $this->idClient);
    }

    public function render(FornitoreService $fornitoreService,
                           CategoriaService $categoriaService)
    {
        return view('livewire.live-top-prova', [
            'fornitori' => $fornitoreService->listaFornitori(),
            'categorie' => $categoriaService->listaCategorie(),
            'listino' => $this->listino,
        ]);
    }
}
