<?php

namespace App\Http\Livewire;

use App\Models\Ruolo;
use App\Services\RuoloService;
use Livewire\Component;

class LiveRuoli extends Component
{

    public $nomeRuolo;

    public function aggiungiRuolo(RuoloService $ruoloService)
    {
       $ruoloService->aggiungiRuolo($this->nomeRuolo);
        $this->nomeRuolo = '';
    }

    public function render(RuoloService $ruoloService)
    {
        return view('livewire.live-ruoli', [
            'ruoli' => $ruoloService->listaRuoli()
        ]);
    }
}
