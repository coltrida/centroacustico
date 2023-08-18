<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Magazzino</h1>
            <div class="row ml-4">
                <div class="col">
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
                <div class="col">
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
                <div class="col">
                    <select class="form-control" aria-label="Default select example" wire:model="listino_id">
                        <option selected>listino...</option>
                        @foreach($listino as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="quantità" aria-label="Last name" wire:model="quantita">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary" wire:click="richiediProdotti"> Richiedi</button>
                </div>
            </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped nowrap"  width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Stato</th>
                        <th>Matricola</th>
                        <th>Nome</th>
                        <th>Fornitore</th>
                        <th>Categoria</th>
                        <th>Paziente</th>
                        <th>Data Carico</th>
                        {{--<th class="text-center">Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($prodotti as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->stato->nome}}</td>
                            <td class="text-nowrap">{{$item->matricola}}</td>
                            <td class="text-nowrap">{{$item->listino->nome}}</td>
                            <td class="text-nowrap">{{$item->listino->fornitore->nome}}</td>
                            <td class="text-nowrap">{{$item->listino->categoria->nome}}</td>
                            <td class="text-nowrap">{{isset($item->client_id) ? $item->cliente->fullName : ''}}</td>
                            <td class="text-nowrap">{{$item->datacarico}}</td>
                            {{--<td class="text-nowrap text-center">
                                <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                   href="#">
                                    <i class="fas fa-fw fa-trash"></i>
                                </a>
                                <a class="btn btn-primary btn-sm mx-1" title="modifica"
                                   href="#">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                </a>
                            </td>--}}
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">{{$prodotti->links()}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
