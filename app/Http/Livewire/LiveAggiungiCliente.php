<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\CanaleService;
use App\Services\ClienteService;
use App\Services\TipoService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class LiveAggiungiCliente extends Component
{
    public $tipi;
    public $canali;
    public $idFiliale;
    public $idClient;

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
    public $dataNascita;

    protected $rules = [
        'nome' => 'required|min:3',
        'cognome' => 'required|min:3',
        'email' => 'required|email',
        'telefono1' => 'required|min:6',
        'telefono2' => 'max:16',
        'tipo_id' => 'required',
        'canale_id' => 'required',
        'indirizzo' => 'max:80',
        'citta' => 'max:50',
        'provincia' => 'max:2',
        'cap' => 'max:7',
        'dataNascita' => 'max:12',
    ];

    public function mount(TipoService $tipoService, CanaleService $canaleService, ClienteService $clienteService)
    {
        $this->tipi = $tipoService->listaTipologia();
        $this->canali = $canaleService->listaCanali();

        if ($this->idClient){
            $clienteDaModificare = $clienteService->clientById($this->idClient);
            $this->nome = $clienteDaModificare->nome;
            $this->cognome = $clienteDaModificare->cognome;
            $this->email = $clienteDaModificare->email;
            $this->telefono1 = $clienteDaModificare->telefono1;
            $this->telefono2 = $clienteDaModificare->telefono2;
            $this->tipo_id = $clienteDaModificare->tipo_id;
            $this->canale_id = $clienteDaModificare->canale_id;
            $this->indirizzo = $clienteDaModificare->indirizzo;
            $this->citta = $clienteDaModificare->citta;
            $this->provincia = $clienteDaModificare->provincia;
            $this->cap = $clienteDaModificare->cap;
            $this->dataNascita = Carbon::make($clienteDaModificare->dataNascita)->format('Y-m-g');
        }
    }

    public function submit(ClienteService $clienteService)
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        $request = new Request();

        $request->request->add([
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
            'dataNascita' => $this->dataNascita,
        ]);

        if (!$this->idClient){
            $clienteService->inserisciCliente($request);

            session()->flash('message', "Paziente $this->nome $this->cognome Inserito");

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
            $this->dataNascita = '';

        } else {
            $clienteService->modificaCliente($this->idClient, $request);
            session()->flash('message', "Paziente $this->nome $this->cognome  Modificato");
        }


        return Redirect::route('clienti', $this->idFiliale);
    }

    public function render()
    {
        return view('livewire.live-aggiungi-cliente');
    }
}
