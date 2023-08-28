<?php

namespace App\Http\Livewire;

use App\Models\Configuration;
use App\Models\Prova;
use App\Services\CanaleService;
use App\Services\CategoriaService;
use App\Services\ConfigurationService;
use App\Services\FatturaService;
use App\Services\FatturatiService;
use App\Services\FornitoreService;
use App\Services\InformazioneService;
use App\Services\ListinoService;
use App\Services\ProdottiService;
use App\Services\ProvaService;
use App\Services\StatoApaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveProva extends Component
{
    public $idClient;

    public $idFiliale;
    public $fornitore_id;
    public $categoria_id;
    public $canale_id;
    public $listino_id;
    public $product_id;
    public $nota;
    public $listino = [];
    public $matricole = [];
    public $totProva = 0;
    public $provaId;
    public $provaFattura;
    public $acconto;
    public $rate;
    public $idProvaFatturata;
    public $idProvaReso;

    public function mount(ProvaService $provaService,
                          ProdottiService $prodottiService,
                          StatoApaService $statoApaService)
    {
        $cliente = $provaService->clientConProvePassate($this->idClient);
        $this->idFiliale = $cliente->filiale_id;
        $this->calcoloTotaleProdottiInCorsoDiProva($prodottiService, $statoApaService);
        $this->canale_id = $cliente->canale_id;
        $this->idProvaFatturata= $statoApaService->idStatoFromNome('FATTURATO');
        $this->idProvaReso= $statoApaService->idStatoFromNome('RESO');
    }

    public function selezionaFornitore(ListinoService $listinoService)
    {
        if (!$this->categoria_id){
            $this->listino = $listinoService->elencoListinoByIdFornitore($this->fornitore_id);
        } else {
            $this->listino = $listinoService->elencoListinoByIdFornitoreAndIdCategoria($this->fornitore_id, $this->categoria_id);
        }
    }

    public function selezionaCategoria(ListinoService $listinoService)
    {
        if (!$this->fornitore_id){
            $this->listino = $listinoService->elencoListinoByIdCategoria($this->categoria_id);
        } else {
            $this->listino = $listinoService->elencoListinoByIdFornitoreAndIdCategoria($this->fornitore_id, $this->categoria_id);
        }
    }

    public function selezionaListino(ProdottiService $prodottiService)
    {
        $this->matricole = $prodottiService->prodottiInMagazzinoFromIdListino($this->listino_id, $this->idFiliale);
    }

    public function inserisciInProva(ProvaService $provaService,
                                     ProdottiService $prodottiService,
                                     StatoApaService $statoApaService)
    {
        $provaService->inserisciProductInProvaById($this->product_id, $this->idClient);
        $this->matricole = $prodottiService->prodottiInMagazzinoFromIdListino($this->listino_id, $this->idFiliale);
        $this->calcoloTotaleProdottiInCorsoDiProva($prodottiService, $statoApaService);
    }

    public function eliminaDaProva(ProvaService $provaService,
                                   ProdottiService $prodottiService,
                                   StatoApaService $statoApaService,
                                   $idproductSelezionato)
    {
        $provaService->eliminaProductInProvaById($idproductSelezionato);
        $this->matricole = $prodottiService->prodottiInMagazzinoFromIdListino($this->listino_id, $this->idFiliale);
        $this->calcoloTotaleProdottiInCorsoDiProva($prodottiService, $statoApaService);
    }

    public function calcoloTotaleProdottiInCorsoDiProva(ProdottiService $prodottiService, StatoApaService $statoApaService)
    {
        $idStatoInCorsoDiProva = $statoApaService->idStatoFromNome('IN PROVA');
        $this->totProva = $prodottiService->importoTotaleProdottiInCorsoDiProva($this->idClient, $idStatoInCorsoDiProva);
    }

    public function creaProva(ProvaService $provaService,
                              ProdottiService $prodottiService,
                              StatoApaService $statoApaService,
                              InformazioneService $informazioneService)
    {
        $request = new Request();
        $request->replace([
            'client_id' => $this->idClient,
            'filiale_id' => $this->idFiliale,
            'tot' => $this->totProva,
            'nota' => $this->nota,
            'canale_id' => $this->canale_id,
        ]);
        $idProva = $provaService->creaProva($request);
        $prodottiInCorsoDiProva = $prodottiService->prodottiInCorsoDiProvaByIdClient($this->idClient);
        $idStatoProvaInCorso = $statoApaService->idStatoFromNome('PROVA IN CORSO');
        $prodottiService->cambioStatoProdotti($prodottiInCorsoDiProva, $idStatoProvaInCorso);
        $prodottiService->assegnaIdProvaAlProdotto($prodottiInCorsoDiProva, $idProva);
        $request = new Request();
        $request->replace([
            'client_id' => $this->idClient,
            'tipo' => 'CREAZIONE PROVA',
            'note' => 'Aperta prova di euro '.$this->totProva,
        ]);
        $informazioneService->inserisciInformazione($request);
        $this->totProva = 0;
        session()->flash('message', "Prova Crata con Successo");
    }

    public function resoProva(ProvaService $provaService,
                              StatoApaService $statoApaService,
                              ProdottiService $prodottiService,
                              InformazioneService $informazioneService,
                              Prova $prova)
    {
        $idStatoReso = $statoApaService->idStatoFromNome('RESO');
        $provaService->resoProva($prova->id, $idStatoReso);
        $prodottiService->cambioStatoProdotti($prova->prodotti, $idStatoReso);
        $request = new Request();
        $request->replace([
            'client_id' => $this->idClient,
            'tipo' => 'RESO PROVA',
            'note' => 'Reso prova di euro '.$prova->tot,
        ]);
        $informazioneService->inserisciInformazione($request);
    }

    public function vediDettagliProva($provaId)
    {
        $this->provaId = $provaId;
    }

    public function infoFattura(Prova $prova)
    {
        $this->provaFattura = $prova;
    }

    public function creaProforma(FatturaService $fatturaService,
                                 StatoApaService $statoApaService,
                                 ProvaService $provaService,
                                 ConfigurationService $configurationService,
                                 FatturatiService $fatturatiService)
    {
        $ultimoProgressivoFattura = $fatturaService->getUltimoProgressivoFattura();

        $request = new Request();
        $request->replace([
            'prova_id' => $this->provaFattura->id,
            'user_id' => $this->provaFattura->user_id,
            'nr_rate' => $this->rate,
            'acconto' => $this->acconto,
            'tot_fattura' => $this->provaFattura->tot,
            'mese_fattura' => Carbon::now()->month,
            'anno_fattura' => Carbon::now()->year,
            'progressivo' => (int) $ultimoProgressivoFattura + 1,
            'al_saldo' => (int) $this->provaFattura->tot - (int) $this->acconto,
            'saldata' => (int) $this->provaFattura->tot == $this->acconto ? 1 : 0,
        ]);

        $fattura = $fatturaService->creaProforma($request);

        $idStatoFattura = $statoApaService->idStatoFromNome('FATTURATO');
        $provaService->proformaProva($this->provaFattura->id, $idStatoFattura);

        $fatturatiService->incrementaFatturato(Auth::id(), $request->anno_fattura, $request->mese_fattura, $request->tot_fattura);

        $fatturaService->creadProformaPdf($fattura, $configurationService->getConfigurazioni());
    }

    public function render(FornitoreService $fornitoreService,
                           CategoriaService $categoriaService,
                           ProdottiService $prodottiService,
                           CanaleService $canaleService,
                           ProvaService $provaService)
    {
        return view('livewire.live-prova', [
            'prodottiInCorsoDiProva' => $prodottiService->prodottiInCorsoDiProvaByIdClient($this->idClient),
            'clientConProvePassate' => $provaService->clientConProvePassate($this->idClient),
            'fornitori' => $fornitoreService->listaFornitori(),
            'categorie' => $categoriaService->listaCategorie(),
            'canali' => $canaleService->listaCanali(),
            'listino' => $this->listino,
            'provaDettagli' => $this->provaId ? $provaService->dettagliProva($this->provaId) : '',
        ]);
    }
}
