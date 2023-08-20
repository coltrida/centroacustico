<?php

namespace App\Http\Livewire;

use App\Services\AppuntamentoService;
use App\Services\FilialeService;
use App\Services\RecapitoService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class LiveAppuntamento extends Component
{
    public $idClient;
    public $dateSettimana = [];
    public $direzione = 0;
    public $dataRicerca;
    public $numeroSettimanaDiOggi = -1;
    public $settimana;
    public $anno;
    public $dataSelezionata;
    public $orarioSelezionato;
    public $nota;
    public $tipo;
    public $recapito_id;
    public $filiale_id;

    public function mount(FilialeService $filialeService)
    {
        $this->produciDate();
        $this->filiale_id = $filialeService->filialeByIdClient($this->idClient)->id;
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

    public function DataOraSelezionata($dataSelezionata, $orario)
    {
        $this->dataSelezionata = $dataSelezionata;
        $this->orarioSelezionato = $orario;
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
            'user_id' => 1,
            'filiale_id' => $this->filiale_id,
            'recapito_id' => $this->recapito_id,
            'mese' => $data->month,
            'anno' => $data->year,
            'settimana' => $data->weekOfYear,
        ]);

        $appuntamentoService->aggiungiAppuntamento($request);
    }

    public function render( AppuntamentoService $appuntamentoService, RecapitoService $recapitoService)
    {
        return view('livewire.live-appuntamento', [
            'userConAppuntamenti' =>
                $appuntamentoService->userConAppuntamentiSettimanaByIdUser(1, $this->settimana, $this->anno),
            'nomeGiorno' => ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'],
            'recapiti' => $recapitoService->listaRecapitiByIdFiliale($this->filiale_id)
        ]);
    }
}
