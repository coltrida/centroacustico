<?php

namespace App\Http\Livewire;

use App\Services\ProdottiService;
use App\Services\StatoApaService;
use Livewire\Component;

class TopHomeAdmin extends Component
{

  //  public $prodottiOrdinati;


    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = ['echo:richiestaApaChannel,RichiestaApaEvent' => 'render'];

    /*public function mount(ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $this->notifyNewOrder($prodottiService, $statoApaService);
    }

    public function notifyNewOrder(ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $idStatoProdottiRichiesti = $statoApaService->idStatoFromNome('RICHIESTO');
        $this->prodottiOrdinati = $prodottiService->listaProdottiRichiesti($idStatoProdottiRichiesti)->toArray();
    }*/

    public function render(ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $idStatoProdottiRichiesti = $statoApaService->idStatoFromNome('RICHIESTO');
        return view('livewire.top-home-admin', [
            'prodottiOrdinati' => $prodottiService->listaProdottiRichiesti($idStatoProdottiRichiesti)
        ]);
    }
}
