<?php

namespace App\Http\Livewire;

use App\Services\ProdottiService;
use App\Services\StatoApaService;
use Livewire\Component;

class TopHomeAdminMagazzino extends Component
{
    protected $listeners = ['echo:richiestaApaChannel,RichiestaApaEvent' => 'render'];

    public function render(ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $idStatoProdottiRichiesti = $statoApaService->idStatoFromNome('RICHIESTO');
        return view('livewire.top-home-admin-magazzino', [
            'prodottiOrdinati' => $prodottiService->listaProdottiRichiesti($idStatoProdottiRichiesti)
        ]);
    }
}
