@extends('layouts.stile')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tipologie</h1>
        <form action="{{route('admin.aggiungiTipologia')}}" method="post">
            @csrf
            <div class="row ml-4">
                <div class="col-8">
                    <input type="text" class="form-control" placeholder="Nome Tipologia" aria-label="First name"
                           name="nome">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary"> Aggiungi</button>
                </div>
            </div>
        </form>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tipologie as $item)
                            <tr>
                                <td class="text-nowrap">{{$item->nome}}</td>
                                <td class="text-nowrap text-center">
                                    <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                       href="#">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </a>
                                    <a class="btn btn-primary btn-sm mx-1" title="modifica"
                                       href="#">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
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
