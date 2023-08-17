<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\CanaleService;
use App\Services\TipoService;
use Livewire\Component;

class LiveAggiungiCliente extends Component
{
    public $tipi;
    public $canali;
    public $idFiliale;

    public $nome;
    public $cognome;
    public $email;
    public $telefono1;
    public $telefono2;
    public $tipo_id;
    public $canale_id;
    public $indirizzo;
    public $citta;
    public $provincia;
    public $cap;

    protected $rules = [
        'nome' => 'required|min:3',
        'cognome' => 'required|min:3',
        'email' => 'required|email',
        'telefono1' => 'required|min:6',
        'telefono2' => 'max:16',
        'tipo_id' => 'required',
        'canale_id' => 'required',
        'indirizzo' => 'max:50',
        'citta' => 'max:50',
        'provincia' => 'max:2',
        'cap' => 'max:7',
    ];

    public function mount(TipoService $tipoService, CanaleService $canaleService)
    {
        $this->tipi = $tipoService->listaTipologia();
        $this->canali = $canaleService->listaCanali();
    }

    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        Client::create([
            'nome' => $this->nome,
            'cognome' => $this->cognome,
            'email' => $this->email,
            'telefono1' => $this->telefono1,
            'telefono2' => $this->telefono2,
            'tipo_id' => $this->tipo_id,
            'canale_id' => $this->canale_id,
            'filiale_id' => $this->idFiliale,
            'indirizzo' => $this->indirizzo,
            'citta' => $this->citta,
            'provincia' => $this->provincia,
            'cap' => $this->cap,
        ]);

        $this->nome = '';
        $this->cognome = '';
        $this->email = '';
        $this->telefono1 = '';
        $this->telefono2 = '';
        $this->tipo_id = '';
        $this->canale_id = '';
        $this->indirizzo = '';
        $this->citta = '';
        $this->provincia = '';
        $this->cap = '';

        session()->flash('message', 'Paziente Creato');
    }

    public function render()
    {
        return view('livewire.live-aggiungi-cliente');
    }
}
