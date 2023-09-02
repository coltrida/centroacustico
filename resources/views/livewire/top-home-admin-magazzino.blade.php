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
                            <td>Filiale</td>
                            <th>Prodotto</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prodottiOrdinati as $item)
                            <tr>
                                <td>{{$item->filiale->nome}}</td>
                                <td>{{$item->listino->nome}}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">{{$prodottiOrdinati->links()}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-body rounded" style="background: dimgrey;">
                    <h3 class="mt-4"></h3>
                    <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                        <thead class="table-light">
                        <tr>
                            <td>Paziente</td>
                            <th>Data</th>
                            <th>Tot</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>

                            </td>
                            <td class="text-nowrap"></td>
                            <td class="text-nowrap"></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>


