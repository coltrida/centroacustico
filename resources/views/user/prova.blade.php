@extends('layouts.stile')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

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

    <div class="d-sm-flex mb-4">
        <h4 class="mb-0 text-gray-800">Prova per {{$clientConProvePassate->fullName}}</h4>

            <livewire:live-top-prova
                :idClient="$idClient"
                :idFiliale="$clientConProvePassate->filiale->id"/>

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
                            @foreach($proveInCorso as $item)
                                <tr>
                                    <td class="text-nowrap">{{$item->matricola}}</td>
                                    <td class="text-nowrap">{{$item->listino->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->categoria->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->prezzolistino}}</td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                           href="#">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
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
                                <th>Matricola</th>
                                <th>Nome</th>
                                <th>Cat</th>
                                <th>Prezzo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientConProvePassate->prove as $item)
                                <tr>
                                    <td class="text-nowrap">{{$item->matricola}}</td>
                                    <td class="text-nowrap">{{$item->listino->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->categoria->nome}}</td>
                                    <td class="text-nowrap">{{$item->listino->prezzolistino}}</td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                           href="#">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </a>
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
@endsection

@section('footerSection')
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    <script>
        $('document').ready(function () {
            let mess = "{{Session::has('message')}}"
            if (mess) {
                $('#exampleModal').modal();
                setTimeout(function () {
                    $('#exampleModal').modal('hide');
                }, 3000);
            }
        });
    </script>
@endsection
