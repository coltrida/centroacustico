<div class="pt-5">
    @if( Session::has('message'))
        <script type="text/javascript">
            $('document').ready(function () {
                let mess = "{{Session::has('message')}}"
                if (mess) {
                    const myModal = new bootstrap.Modal('#exampleModal')
                    myModal.show();
                    setTimeout(function () {
                        myModal.hide();
                    }, 3000);
                }
            });
        </script>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                </div>
                <div class="modal-body">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoProva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5">Info Prova</h4>
                    <div>
                        Canale: {{$provaDettagli ? $provaDettagli->canale->nome: ''}}
                    </div>
                </div>
                <h5 class="ml-3">Prodotti</h5>
                <div class="modal-body">
                    @if($provaId)
                        <div class="row">
                            <div class="col-4"><b>MATRICOLA</b></div>
                            <div class="col-4"><b>PRODOTTO</b></div>
                            <div class="col-4"><b>PREZZO</b></div>
                        </div>
                        @foreach($provaDettagli->prodotti as $item)
                            <div class="row">
                                <div class="col-4">{{$item->matricola}}</div>
                                <div class="col-4">{{$item->listino->nome}}</div>
                                <div class="col-4">{{$item->listino->prezzolistino}}</div>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            <h5>Note: {{$provaDettagli->note}}</h5>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoFattura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5">Info Fattura</h4>
                    <div>
                        Canale: {{$provaFattura ? $provaFattura->canale->nome: ''}}
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" wire:model.defer="acconto" class="form-control" placeholder="Acconto" aria-label="First name">
                        </div>
                        <div class="col">
                            <input type="text" wire:model.defer="rate" class="form-control" placeholder="Rate" aria-label="Last name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer align-items-center justify-content-between">
                    <div>
                        Tot Fattura: {{$provaFattura ? $provaFattura->tot: ''}}
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click="creaProforma" class="btn btn-success" data-bs-dismiss="modal">Crea Proforma</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 text-gray-800">Prova per {{$clientConProvePassate->fullName}}</h4>

        <div class="row">
            <div class="col">
                <select style="min-width: 170px" class="form-select" aria-label="Default select example"
                        wire:model="fornitore_id"
                        wire:change="selezionaFornitore"
                >
                    <option selected>fornitore...</option>
                    @foreach($fornitori as $fornitore)
                        <option value="{{$fornitore->id}}">{{$fornitore->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select style="min-width: 80px" class="form-select" aria-label="Default select example"
                        wire:model="categoria_id"
                        wire:change="selezionaCategoria"
                >
                    <option selected>categ...</option>
                    @foreach($categorie as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select style="min-width: 150px" style="min-width: 50px" class="form-select" aria-label="Default select example"
                        wire:model="listino_id"
                        wire:change="selezionaListino"
                >
                    <option selected>listino...</option>
                    @foreach($listino as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select style="min-width: 150px" class="form-select" aria-label="Default select example" wire:model="product_id">
                    <option selected>matricola...</option>
                    @foreach($matricole as $item)
                        <option value="{{$item->id}}">{{$item->matricola}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary" wire:click="inserisciInProva"> Inserisci</button>
            </div>
            <div class="col">
                <a type="submit" class="btn btn-warning" href="{{ route('clienti', $idFiliale) }}"> Indietro</a>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body rounded p-3" style="background: dimgrey;">
                    <div class="d-flex mb-2 flex-row align-items-center justify-content-between">
                        <h3>Nuova Prova</h3>
                        <div class="d-flex align-items-center">
                            <div class="mx-2">Canale: </div>
                            <select class="form-control" aria-label="Default select example"
                                    wire:model="canale_id"
                            >
                                @foreach($canali as $canale)
                                    <option value="{{$canale->id}}">
                                            {{$canale->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped nowrap" width="100%" cellspacing="0">
                            <thead class="table-light">
                            <tr>
                                <th>Matricola</th>
                                <th>Nome</th>
                                <th>Cat</th>
                                <th>Prezzo</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($prodottiInCorsoDiProva as $item)
                                <tr>
                                    <td class="text-nowrap">{{$item->matricola}}</td>
                                    <td class="text-nowrap">{{$item->listino->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->categoria->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->prezzolistino}}</td>
                                    <td class="text-nowrap text-center">
                                        <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                           href="#" wire:click="eliminaDaProva({{$item->id}})">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Nota</label>
                            <textarea wire:model="nota" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                        </div>

                        <div class="d-sm-flex align-items-center justify-content-between">
                            <div>
                                Tot. Prova: € {{$totProva}}
                            </div>
                            <button type="submit" class="btn btn-primary" wire:click="creaProva"> Crea Prova</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body rounded p-3" style="background: dimgrey;">
                    <h3 >Prove Passate</h3>
                    <div class="table-responsive">
                        <table class="table table-sm mt-2 table-bordered table-striped nowrap" width="100%" cellspacing="0">
                            <thead class="table-light">
                            <tr>
                                <th>Stato</th>
                                <th>Data</th>
                                <th>Tot</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientConProvePassate->prove as $item)
                                <tr>

                                    <td class="text-nowrap">
                                        <span class="badge"
                                              style="{{$item->stato->nome == 'RESO' ?
                                                'background: red; color: white; padding: 10px' :
                                                    'background: green; color: white; padding: 10px'}}">
                                            {{$item->stato->nome}}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                                    <td class="text-nowrap">{{$item->tot}}</td>
                                    <td class="text-nowrap text-center">
                                        <button title="Informazioni"
                                                wire:click="vediDettagliProva({{$item->id}})"
                                                type="button"
                                                class="btn btn-primary btn-sm mx-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#infoProva">
                                            <i class="bi bi-info-circle"></i>
                                        </button>
                                        @if($item->stato_id != $idProvaFatturata && $item->stato_id != $idProvaReso)
                                        <button title="Proforma"
                                                wire:click="infoFattura({{$item}})"
                                                type="button"
                                                class="btn btn-success btn-sm mx-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#infoFattura">
                                            <i class="bi bi-currency-dollar"></i>
                                        </button>
                                        <a class="btn btn-danger btn-sm mx-1" title="reso"
                                           href="#" wire:click="resoProva({{$item}})">
                                            <i class="bi bi-hand-thumbs-down"></i>
                                        </a>
                                        @endif

                                        @if($item->stato_id == $idProvaFatturata)
                                            <a class="btn btn-success btn-sm mx-1" title="fattura" target="_blank"
                                               href="{{asset("storage/documenti/$clientConProvePassate->id/Fattura".$item->fattura->id.".pdf")}}">
                                                <i class="bi bi-receipt"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
