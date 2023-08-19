<div>
    @if( Session::has('message'))
        <script type="text/javascript">
            $(document).ready(function () {
                $('#exampleModal').modal();
                setTimeout(function () {
                    $('#exampleModal').modal('hide');
                }, 3000);
            });
        </script>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Info</h4>
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
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Info Prova</h4>
                </div>
                <h5 class="ml-3">Prodotti</h5>
                <div class="modal-body">
                    @if($provaId)
                        @foreach($provaDettagli->prodotti as $item)
                            <div class="row">
                                <div class="col-4">{{$item->matricola}}</div>
                                <div class="col-4">{{$item->listino->nome}}</div>
                                <div class="col-4">{{$item->listino->prezzolistino}}</div>
                            </div>
                        @endforeach
                        <div class="mt-2">
                            <h5>Note: {{$provaDettagli->note}}</h5>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#infoProva').modal('hide');">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex mb-4">
        <h4 class="mb-0 text-gray-800">Prova per {{$clientConProvePassate->fullName}}</h4>

            <div class="col-2">
                <select class="form-control" aria-label="Default select example"
                        wire:model="fornitore_id"
                        wire:change="selezionaFornitore"
                >
                    <option selected>fornitore...</option>
                    @foreach($fornitori as $fornitore)
                        <option value="{{$fornitore->id}}">{{$fornitore->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <select class="form-control" aria-label="Default select example"
                        wire:model="categoria_id"
                        wire:change="selezionaCategoria"
                >
                    <option selected>categoria...</option>
                    @foreach($categorie as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <select class="form-control" aria-label="Default select example"
                        wire:model="listino_id"
                        wire:change="selezionaListino"
                >
                    <option selected>listino...</option>
                    @foreach($listino as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <select class="form-control" aria-label="Default select example" wire:model="product_id">
                    <option selected>matricola...</option>
                    @foreach($matricole as $item)
                        <option value="{{$item->id}}">{{$item->matricola}}</option>
                    @endforeach
                </select>
            </div>
            <div >
                <button type="submit" class="btn btn-primary" wire:click="inserisciInProva"> Inserisci</button>
            </div>


    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>Nuova Prova</h3>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped nowrap" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Matricola</th>
                                <th>Nome</th>
                                <th>Cat</th>
                                <th>Prezzo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($prodottiInCorsoDiProva as $item)
                                <tr>
                                    <td class="text-nowrap">{{$item->matricola}}</td>
                                    <td class="text-nowrap">{{$item->listino->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->categoria->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->prezzolistino}}</td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                           href="#" wire:click="eliminaDaProva({{$item->id}})">
                                            <i class="fas fa-fw fa-trash"></i>
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
                <div class="card-body">
                    <h3>Prove Passate</h3>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped nowrap" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Stato</th>
                                <th>Data</th>
                                <th>Tot</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientConProvePassate->prove as $item)
                                <tr>
                                    <td class="text-nowrap">{{$item->stato->nome}}</td>
                                    <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                                    <td class="text-nowrap">{{$item->tot}}</td>
                                    <td class="text-nowrap">
                                        <a wire:click="vediDettagliProva({{$item->id}})" class="btn btn-primary btn-sm mx-1" title="vedi"
                                           href="#" onclick="$('#infoProva').modal();">
                                            <i class="fas fa-fw fa-eye"></i>
                                        </a>
                                        @if($item->stato_id != 6 && $item->stato_id != 7)
                                        <a class="btn btn-success btn-sm mx-1" title="fattura"
                                           href="#">
                                            <i class="fas fa-fw fa-cash-register"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm mx-1" title="reso"
                                           href="#" wire:click="resoProva({{$item}})">
                                            <i class="fas fa-fw fa-trash"></i>
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
