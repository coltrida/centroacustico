<div>
    <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5">Info</h4>
                </div>
                <div class="modal-body">
                    {{ session('message') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="appuntamentoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" >
                        Appuntamento per il {{$dataSelezionata}} ore {{$orarioSelezionato}}:00
                    </h5>

                    <a href="#" data-dismiss="modal" title="exit">
                        <i class="fas fa-fw fa-caret-square-right"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <select class="form-control" aria-label="Default select example" wire:model.defer="tipo">
                        <option selected>Tipo Appuntamento</option>
                        <option>Prima Visita</option>
                        <option>Consegna Apa</option>
                        <option>Controllo</option>
                        <option>Assistenza</option>
                    </select>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Filiale
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Recapito
                        </label>
                        <select class="form-control" aria-label="Default select example" wire:model.defer="recapito_id">
                            <option selected>Recapiti</option>
                            @foreach($recapiti as $item)
                                <option value="{{$item->id}}">{{$item->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="exampleFormControlTextarea1" class="form-label mb-0">Nota</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="nota"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    @if(!$appuntamentoPrenotato)
                    <button type="button" wire:click="inserisciAppuntamento" class="btn btn-success" data-bs-dismiss="modal">Inserisci</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @else
                        @if($intervenuto !== null)
                            @if($intervenuto === 1)
                                <h3><span class="badge bg-success text-white">Intervenuto</span></h3>
                            @else
                                <h3><span class="badge bg-danger text-white">Non Intervenuto</span></h3>
                            @endif
                        @else
                            <button type="button" wire:click="esita(1)" class="btn btn-success" data-bs-dismiss="modal">Positivo</button>
                            <a href="#" wire:click="esita(0)" class="btn btn-danger" data-bs-dismiss="modal">Negativo</a>
                            <a href="#" wire:click="eliminaAppuntamento" class="btn btn-danger" data-bs-dismiss="modal" title="Elimina">
                                <i class="bi bi-trash"></i>
                            </a>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Appuntamenti {{$cliente->fullName}} - settimana {{$settimana}}</h1>
    </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex">
                <div>
                    <label class="form-label">Data Appuntamento</label>
                    <input type="date" class="form-control" aria-label="First name" wire:model="dataRicerca" wire:change="ricercaData">
                </div>
                <div class="ml-3">
                    <label for="exampleFormControlTextarea1" class="form-label">&nbsp;</label> <br>
                    <a type="submit" class="btn btn-warning" wire:click="tornaAdOggi" href="#"> Oggi</a>
                </div>
            </div>

            <div>
                <label for="exampleFormControlTextarea1" class="form-label">&nbsp;</label> <br>
                <a type="submit" class="btn btn-warning" href="{{ route('clienti', $filiale_id) }}"> Indietro</a>
            </div>
        </div>

    <div class="card shadow mb-4">
        <div class="card-body rounded" style="background: dimgrey;">
            <div class="d-flex flex-row-reverse">
                <div class="btn-group" role="group" aria-label="Default button group">
                    <a href="#" wire:click="indietro" style="color: white; border: 1px solid white"
                       class="btn btn-outline-primary">Indietro</a>
                    <a href="#" wire:click="avanti" style="color: white; border: 1px solid white"
                       class="btn btn-outline-primary">Avanti</a>
                </div>
            </div>

            <div class="row mt-3">
                <div class="list-group col-1">
                    <br>
                    @for($ora=9; $ora < 19; $ora++)
                        <div class="list-group-item list-group-item-dark"
                             style="font-size: 14px; padding: 0.4rem 0.2rem">
                            {{$ora == 9 ? '0'.$ora.':00-'.($ora+1).':00' : $ora.':00-'.($ora+1).':00'}}
                        </div>
                    @endfor
                </div>
                @for($giorno=0; $giorno < 6; $giorno++)

                    <div class="list-group col">
                        <span class="text-center" style="font-size: 14px;
                                {{$giorno == $numeroSettimanaDiOggi && $settimanaDiOggi == $settimana ? 'background:blue; color:white' : ''}}">
                            {{$nomeGiorno[$giorno]}} - {{$dateSettimana[$giorno]}}
                        </span>
                        @for($ora=9; $ora < 19; $ora++)

                            <button wire:click="DataOraSelezionata('{{$dateSettimana[$giorno]}}', '{{$ora}}', '{{$userConAppuntamenti->appuntamenti->where('orario', $ora)->where('giornoFormattato', $dateSettimana[$giorno])->first()}}')"
                                    data-bs-toggle="modal" data-bs-target="#appuntamentoModal"
                               class="list-group-item list-group-item-action text-center list-group-item-secondary"
                               style="font-size: 14px; padding: 0.4rem 0.2rem;
                               @if($appunta = $userConAppuntamenti->appuntamenti
                                                ->where('orario', $ora)->where('giornoFormattato', $dateSettimana[$giorno])->first())
                                    @if($appunta->intervenuto === 1)
                                        {{'background:green; color:white'}}
                                    @elseif($appunta->intervenuto === 0)
                                        {{'background:red; color:white'}}
                                        @else
                                        {{'background:gray; color:white'}}
                                    @endif
                                @else
                                    {{''}}
                                @endif">
                                {{--{{$appunta = $userConAppuntamenti->appuntamenti
                                                ->where('orario', $ora)->where('giornoFormattato', $dateSettimana[$giorno])->first() ?
                                    $appunta :
                                        $dateSettimana[$giorno]}}--}}

                                @if($appunta)
                                    {{$appunta->client->fullName}}
                                @else
                                    &ensp;
                                @endif
                            </button>
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
