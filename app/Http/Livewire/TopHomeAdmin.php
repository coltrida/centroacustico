<?php

namespace App\Http\Livewire;

use App\Services\ProdottiService;
use App\Services\ProvaService;
use App\Services\StatoApaService;
use Livewire\Component;

class TopHomeAdmin extends Component
{


    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = [
            'echo:nuovaProvaInCorsoChannel,NuovaProvaInCorsoEvent' => 'render',
            'echo:nuovaProvaFatturataChannel,NuovaProvaFatturataEvent' => 'render',
        ];

    public function render(ProvaService $provaService, StatoApaService $statoApaService)
    {
        $idStatoProvaInCorso = $statoApaService->idStatoFromNome('PROVA IN CORSO');
        $idStatoFatturato = $statoApaService->idStatoFromNome('FATTURATO');
        return view('livewire.top-home-admin', [
            'proveInCorso' => $provaService->proveInCorso($idStatoProvaInCorso),
            'proveFatturate' => $provaService->proveFatturate($idStatoFatturato),
        ]);
    }
}
