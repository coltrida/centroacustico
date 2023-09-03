<div class="container" style="padding-top: 70px">

    <ul class="nav nav-tabs justify-content-center pt-5">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('admin.home')}}">Commerciale</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('admin.homeMagazzino')}}">Richieste Prodotti</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.homeTelefonate')}}">Telefonate</a>
        </li>
    </ul>

    <div class="row text-center mt-4">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-body rounded text-white" style="background: dimgrey;">
                    <h3 class="mt-4">Richiesta Prodotti</h3>
                    <table class="table table-dark table-striped table-bordered nowrap" width="100%" cellspacing="0">
                        <thead class="table-light">
                        <tr>
                            <td>Data Richiesta</td>
                            <td>Filiale</td>
                            <th>Prodotto</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prodottiOrdinati as $item)
                            <tr class="align-middle">
                                <td>{{$item->created_at->format('d-m-Y')}}</td>
                                <td>{{$item->filiale->nome}}</td>
                                <td>{{$item->listino->nome}}</td>
                                <td>
                                    <a href="#" wire:click = "caricaProdottoPerSpedizione({{$item->id}})" class="btn btn-success" title="spedisci">
                                        <i class="bi bi-truck"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">{{$prodottiOrdinati->links()}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-body rounded" style="background: dimgrey;">
                    <h3 class="mt-4 text-white">Da Spedire</h3>
                    <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                        <thead class="table-light">
                        <tr>
                            <td>Filiale</td>
                            <th>Prodotto</th>
                            <th>Matricola</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prodottiCaricatiPerSpedizione as $item)
                        <tr class="align-middle">
                            <td >{{$item->filiale->nome}}</td>
                            <td >{{$item->listino->nome}}</td>
                            <td class="d-flex justify-content-center">
                                @if(!$item->matricola)
                                <input type="text" wire:model.defer="matricola" class="form-control" style="margin-right: 10px" placeholder="matricola">
                                <a href="#" class="btn btn-success" wire:click = assegnaMatricola({{$item->id}})>
                                    <i class="bi bi-check-circle"></i>
                                </a>
                                @else
                                   {{$item->matricola}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($prodottiCaricatiPerSpedizione->count() > 0)
                    <a href="#" class="btn btn-primary" wire:click = daSpedire>
                        DA SPEDIRE
                    </a>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>


