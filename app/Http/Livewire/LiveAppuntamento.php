<?php

namespace App\Http\Livewire;

use App\Services\AppuntamentoService;
use App\Services\ClienteService;
use App\Services\FilialeService;
use App\Services\RecapitoService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Psy\Util\Json;

class LiveAppuntamento extends Component
{
    public $idClient;
    public $dateSettimana = [];
    public $direzione = 0;
    public $dataRicerca;
    public $numeroSettimanaDiOggi = -1;
    public $settimanaDiOggi;
    public $settimana;
    public $anno;
    public $dataSelezionata;
    public $orarioSelezionato;
    public $nota;
    public $tipo;
    public $recapito_id;
    public $filiale_id;
    public $user;
    public $appuntamentoPrenotato;
    public $appuntamento_id;
    public $intervenuto;

    public function mount(FilialeService $filialeService, AppuntamentoService $appuntamentoService)
    {
        $this->produciDate();
        $this->filiale_id = $filialeService->filialeByIdClient($this->idClient)->id;
        $this->user = $appuntamentoService->userConAppuntamentiSettimanaByIdUser(Auth::id(), $this->settimana, $this->anno);
        $this->settimanaDiOggi = Carbon::now()->weekOfYear;
    }

    public function produciDate()
    {
        $oggi = Carbon::now()->format('d-m-Y');
        $this->dateSettimana = [];
        $sommaOsottrai = 7 * $this->direzione;

        if ($this->dataRicerca){
            $this->settimana = Carbon::make($this->dataRicerca)->addDays($sommaOsottrai)->weekOfYear;
            $this->anno = Carbon::make($this->dataRicerca)->addDays($sommaOsottrai)->year;
        } else{
            $this->settimana = Carbon::now()->addDays($sommaOsottrai)->weekOfYear;
            $this->anno = Carbon::now()->addDays($sommaOsottrai)->year;
        }

        for ($indiceGiorno=0; $indiceGiorno < 6; $indiceGiorno++){
            if ($this->dataRicerca){
                $giorno = Carbon::make($this->dataRicerca)->startOfWeek()->addDays($indiceGiorno + $sommaOsottrai)->format('d-m-Y');
            }else {
                $giorno = Carbon::now()->startOfWeek()->addDays($indiceGiorno + $sommaOsottrai)->format('d-m-Y');
            }
            array_push($this->dateSettimana, $giorno);
            if ($oggi == $giorno) {
                $this->numeroSettimanaDiOggi = $indiceGiorno;
            }
        }
    }

    public function ricercaData()
    {
        $this->direzione = 0;
        $this->produciDate();
    }

    public function tornaAdOggi()
    {
        $this->direzione = 0;
        $this->dataRicerca = Carbon::now()->format('Y-m-d');
        $this->produciDate();
    }

    public function avanti()
    {
        $this->direzione++;
        $this->produciDate();
    }

    public function indietro()
    {
        $this->direzione--;
        $this->produciDate();
    }

    public function DataOraSelezionata($dataSelezionata, $orario, $appuntamento)
    {
        $this->appuntamentoPrenotato = false;
        $this->tipo = '';
        $this->nota = '';
        $this->recapito_id = '';
        $this->appuntamento_id = '';
        $this->intervenuto = '';
        $this->dataSelezionata = $dataSelezionata;
        $this->orarioSelezionato = $orario;
        if ($appuntamento){
            $this->appuntamentoPrenotato = true;
            $appuntamentoArray = json_decode($appuntamento, true);
            $this->tipo = $appuntamentoArray['tipo'];
            $this->nota = $appuntamentoArray['nota'];
            $this->recapito_id = $appuntamentoArray['recapito_id'];
            $this->appuntamento_id = $appuntamentoArray['id'];
            $this->intervenuto = $appuntamentoArray['intervenuto'];
        }
    }

    public function esita($valoreEsito, AppuntamentoService $appuntamentoService)
    {
        $appuntamentoService->aggiornaEsitoAppuntamento($this->appuntamento_id, $valoreEsito);
    }

    public function inserisciAppuntamento(AppuntamentoService $appuntamentoService)
    {
        $request = new Request();
        $data = Carbon::make($this->dataSelezionata);
        $dataFormattata = Carbon::make($this->dataSelezionata)->format('d-m-Y');
        $request->replace([
            'giorno' => $data,
            'giornoFormattato' => $dataFormattata,
            'orario' => $this->orarioSelezionato,
            'nota' => $this->nota,
            'tipo' => $this->tipo,
            'client_id' => $this->idClient,
            'user_id' => Auth::id(),
            'filiale_id' => $this->filiale_id,
            'recapito_id' => $this->recapito_id,
            'mese' => $data->month,
            'anno' => $data->year,
            'settimana' => $data->weekOfYear,
        ]);

        $appuntamentoService->aggiungiAppuntamento($request);
    }

    public function render( AppuntamentoService $appuntamentoService, RecapitoService $recapitoService, ClienteService $clienteService)
    {
        return view('livewire.live-appuntamento', [
            'userConAppuntamenti' =>
                $appuntamentoService->userConAppuntamentiSettimanaByIdUser(Auth::id(), $this->settimana, $this->anno),
            'nomeGiorno' => ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'],
            'recapiti' => $recapitoService->listaRecapitiByIdFiliale($this->filiale_id),
            'cliente' => $clienteService->clientById($this->idClient),
        ]);
    }
}
