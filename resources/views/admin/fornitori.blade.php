@extends('layouts.stile2')
@section('content')
    <div class="container pt-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Fornitori</h1>
        <form action="{{route('admin.aggiungiFornitore')}}" method="post">
            @csrf
            <div class="row ml-4">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nome Filiale" aria-label="First name"
                           name="nome">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Indirizzo" aria-label="Last name"
                           name="indirizzo">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Città" aria-label="Last name" name="citta">
                </div>
                <div class="col-1">
                    <input type="text" class="form-control" placeholder="PR" aria-label="Last name" name="provincia">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Telefono" aria-label="Last name"
                           name="telefono">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary"> Aggiungi</button>
                </div>
            </div>
        </form>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body rounded" style="background: dimgrey;">
            <div class="table-responsive">
                <table class="table table-bordered table-striped nowrap" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Indirizzo</th>
                        <th>Città</th>
                        <th>Provincia</th>
                        <th>cap</th>
                        <th>Telefono</th>
                        <th>email</th>
                        <th>pec</th>
                        <th>cod Univ</th>
                        <th>iban</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fornitori as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->nome}}</td>
                            <td class="text-nowrap">{{$item->indirizzo}}</td>
                            <td class="text-nowrap">{{$item->citta}}</td>
                            <td class="text-nowrap">{{$item->provincia}}</td>
                            <td class="text-nowrap">{{$item->cap}}</td>
                            <td class="text-nowrap">{{$item->telefono}}</td>
                            <td class="text-nowrap">{{$item->email}}</td>
                            <td class="text-nowrap">{{$item->pec}}</td>
                            <td class="text-nowrap">{{$item->univoco}}</td>
                            <td class="text-nowrap">{{$item->iban}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@endsection
