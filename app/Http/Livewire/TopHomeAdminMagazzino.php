<?php

namespace App\Http\Livewire;

use App\Services\ProdottiService;
use App\Services\StatoApaService;
use Livewire\Component;

class TopHomeAdminMagazzino extends Component
{

    public $matricola;

    protected $listeners = ['echo:richiestaApaChannel,RichiestaApaEvent' => 'render'];

    public function caricaProdottoPerSpedizione($idProdotto, ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $idStatoProdottiInCarico = $statoApaService->idStatoFromNome('IN CARICO');
        $prodottiService->cambioStatoProdotto($idProdotto, $idStatoProdottiInCarico);
    }

    public function assegnaMatricola($idProdotto, ProdottiService $prodottiService)
    {
        $prodottiService->assegnaMatricola($idProdotto, $this->matricola);
    }

    public function daSpedire(StatoApaService $statoApaService, ProdottiService $prodottiService)
    {
        $idStatoProdottiInCarico = $statoApaService->idStatoFromNome('IN CARICO');
        $idStatoProdottiSpedito = $statoApaService->idStatoFromNome('SPEDITO');
        $prodottiInCarico = $prodottiService->listaProdottiCaricatiPerSpedizione($idStatoProdottiInCarico);
        $prodottiService->cambioStatoProdotti($prodottiInCarico, $idStatoProdottiSpedito);


    }

    public function render(ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $idStatoProdottiRichiesti = $statoApaService->idStatoFromNome('RICHIESTO');
        $idStatoProdottiInCarico = $statoApaService->idStatoFromNome('IN CARICO');
        return view('livewire.top-home-admin-magazzino', [
            'prodottiOrdinati' => $prodottiService->listaProdottiRichiesti($idStatoProdottiRichiesti),
            'prodottiCaricatiPerSpedizione' => $prodottiService->listaProdottiCaricatiPerSpedizione($idStatoProdottiInCarico),
        ]);
    }
}
