@extends('layouts.stile2')
@section('content')
    <div class="container pt-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Filiali</h1>
                    <form action="{{route('admin.aggiungiFiliale')}}" method="post">
                        @csrf
                        <div class="row justify-content-end">
                            <div class="col-sm-2">
                                <input type="text" class="form-control mx-1" placeholder="Nome Filiale" aria-label="First name" name="nome">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="Indirizzo" aria-label="Last name" name="indirizzo">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="Città" aria-label="Last name" name="citta">
                            </div>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" placeholder="PR" aria-label="Last name" name="provincia">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="telefono" aria-label="Last name" name="telefono">
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary"> Aggiungi</button>
                            </div>
                        </div>

                    </form>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body rounded" style="background: dimgrey;">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Indirizzo</th>
                            <th>Città</th>
                            <th>Provincia</th>
                            <th>Telefono</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($filiali as $filiale)
                            <tr>
                                <td>{{$filiale->nome}}</td>
                                <td>{{$filiale->indirizzo}}</td>
                                <td>{{$filiale->citta}}</td>
                                <td>{{$filiale->provincia}}</td>
                                <td>{{$filiale->telefono}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
