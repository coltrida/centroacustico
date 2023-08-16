@extends('layouts.stile')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Filiali</h1>
        <form action="{{route('admin.aggiungiFiliale')}}" method="post">
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

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
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

@endsection

@section('footerSection')
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
