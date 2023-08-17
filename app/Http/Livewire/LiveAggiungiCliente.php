<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\TipoService;
use Livewire\Component;

class LiveAggiungiCliente extends Component
{
    public $tipi;
    public $idFiliale;

    public $nome;
    public $cognome;
    public $email;
    public $telefono1;
    public $telefono2;
    public $tipo_id;
    public $indirizzo;
    public $citta;
    public $provincia;
    public $cap;

    protected $rules = [
        'nome' => 'required|min:3',
        'cognome' => 'required|min:3',
        'email' => 'required|email',
        'telefono1' => 'required|min:6',
        'telefono2' => 'min:6',
        'tipo_id' => 'required',
        'indirizzo' => 'min:3',
        'citta' => 'min:3',
        'provincia' => 'min:2',
        'cap' => 'min:4',
    ];

    public function mount(TipoService $tipoService)
    {
        $this->tipi = $tipoService->listaTipologia();
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
