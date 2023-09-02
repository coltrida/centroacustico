<div class="container" style="padding-top: 70px">
    <div class="row text-center">
        <div class="col-4">
            <h3 class="mt-4">Richiesta Prodotti</h3>
            <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
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
