<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\PersonaleService;
use App\Services\RuoloService;
use Livewire\Component;

class LivePersonale extends Component
{
    public User $userElimina;
    public User $userAggiungi;

    protected $rules = [
        'userAggiungi.nome' => 'required|string|min:6',
        'userAggiungi.email' => 'required|email|max:500',
        'userAggiungi.ruolo_id' => 'required',
    ];

    public function mount()
    {
        $this->userAggiungi = new User();
    }

    public function aggiungiPersonale(PersonaleService $personaleService)
    {
        $personaleService->aggiungiPersonale($this->userAggiungi);
    }

    public function confermaEliminaPersonale($user)
    {
        $this->userElimina = new User($user);
    }

    public function eliminaPersonale(PersonaleService $personaleService)
    {
        //dd($this->userElimina);
        $personaleService->deletePersonale($this->userElimina);
    }

    public function render(RuoloService $ruoloService, PersonaleService $personaleService)
    {
        return view('livewire.live-personale', [
            'ruoli' => $ruoloService->listaRuoli(),
            'personale' => $personaleService->listaPersonale(),
        ]);
    }
}
