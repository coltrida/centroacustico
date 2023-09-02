<div class="container" style="padding-top: 70px">

    <ul class="nav nav-tabs justify-content-center pt-5">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('admin.home')}}">Commerciale</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.homeMagazzino')}}">Richieste Prodotti</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.homeTelefonate')}}">Telefonate</a>
        </li>
    </ul>

    <div class="row text-center text-white">
        <div class="col">
            <h3>Fatturato del Mese</h3>
            0
        </div>
        <div class="col">
            <h3>Fatturato Anno</h3>
            0
        </div>
    </div>

    <div class="row text-center mt-4">
        <div class="col-12 col-sm-6">
            <div class="card shadow mb-4">
                <div class="card-body rounded text-white" style="background: dimgrey;">
                    <h3 class="mt-4">Prove in Corso</h3>
                    <table class="table table-dark table-striped table-bordered nowrap" width="100%" cellspacing="0">
                        <thead class="table-light">
                        <tr>
                            <td>Audio</td>
                            <th>Client</th>
                            <th>Tot</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($proveInCorso as $item)
                            <tr>
                                <td>{{$item->user->nome}}</td>
                                <td>{{$item->client->fullName}}</td>
                                <td>{{$item->tot_formattato}}</td>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b>Totale</b></td>
                            <td></td>
                            <td>
                                <b>
                                    {{$proveInCorso->count() > 0 ?
                                     '€ '.number_format( (float) $proveInCorso->sum('tot'), '0', ',', '.') : 0}}
                                </b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="card shadow mb-4">
                <div class="card-body rounded text-white" style="background: dimgrey;">
                    <h3 class="mt-4">Fatturato del Mese</h3>
                    <table class="table table-dark table-striped table-bordered nowrap" width="100%" cellspacing="0">
                        <thead class="table-light">
                        <tr>
                            <td>Audio</td>
                            <th>Tot</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($proveFatturate as $item)
                            <tr>
                                <td>{{$item[0]->user->nome}}</td>
                                <td>
                                    {{$item->count() > 0 ?
                                             '€ '.number_format( (float) $item->sum('tot'), '0', ',', '.') : 0}}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><b>Totale</b></td>
                                <td>
                                    <b>
                                        {{--{{$proveFatturate->count() > 0 ?
                                         '€ '.number_format( (float) $totaleMese, '0', ',', '.') : 0}}--}}
                                    </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

