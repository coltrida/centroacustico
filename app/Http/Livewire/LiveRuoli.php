<?php

namespace App\Http\Livewire;

use App\Models\Ruolo;
use Livewire\Component;

class LiveRuoli extends Component
{

    public $nomeRuolo;

    public function aggiungiRuolo()
    {
        Ruolo::create([
            'nome' => $this->nomeRuolo
        ]);

        $this->nomeRuolo = '';
    }

    public function render()
    {
        return view('livewire.live-ruoli', [
            'ruoli' => Ruolo::latest()->get()
        ]);
    }
}
