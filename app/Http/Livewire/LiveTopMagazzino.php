<?php

namespace App\Http\Livewire;

use App\Services\CategoriaService;
use App\Services\FornitoreService;
use App\Services\ListinoService;
use App\Services\ProdottiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class LiveTopMagazzino extends Component
{
    public $idFiliale;

    public $fornitore_id;
    public $categoria_id;
    public $listino_id;
    public $quantita;

    public $listino = [];

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

    public function richiediProdotti(ProdottiService $prodottiService)
    {
        $request = new Request();

        $request->replace([
            'filiale_id' => $this->idFiliale,
            'listino_id' => $this->listino_id,
            'quantita' => $this->quantita,
        ]);

        $prodottiService->richiediProdottoFromFiliale($request);
        $this->fornitore_id = '';
        $this->categoria_id = '';
        $this->listino_id = '';
        $this->quantita = '';

        return Redirect::route('prodottiRichiesti', $this->idFiliale);
    }

    public function render(FornitoreService $fornitoreService,
                           CategoriaService $categoriaService)
    {
        return view('livewire.live-top-magazzino', [
            'fornitori' => $fornitoreService->listaFornitori(),
            'categorie' => $categoriaService->listaCategorie(),
            'listino' => $this->listino,
        ]);
    }
}
