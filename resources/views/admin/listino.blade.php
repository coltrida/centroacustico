@extends('layouts.stile2')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container pt-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listino</h1>
        <form action="{{route('admin.aggiungiListino')}}" method="post">
            @csrf
            <div class="row ml-4">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nome" aria-label="First name"
                           name="nome">
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="fornitore_id">
                        <option selected>fornitore...</option>
                        @foreach($fornitori as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="categoria_id">
                        <option selected>categoria...</option>
                        @foreach($categorie as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" placeholder="prezzo" aria-label="Last name"
                           name="prezzolistino">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Tempi Reso" aria-label="Last name"
                           name="giorniTempoDiReso">
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
                <table class="table table-bordered table-striped nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Fornitore</th>
                        <th>Categoria</th>
                        <th>Prezzo Listino</th>
                        <th>Tempo di Reso</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listino as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->nome}}</td>
                            <td class="text-nowrap">{{$item->fornitore->nome}}</td>
                            <td class="text-nowrap">{{$item->categoria->nome}}</td>
                            <td class="text-nowrap">{{$item->prezzolistino}}</td>
                            <td class="text-nowrap">{{$item->giorniTempoDiReso}}</td>
                            <td class="text-nowrap text-center">
                                <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                   href="#">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <a class="btn btn-primary btn-sm mx-1" title="modifica"
                                   href="#">
                                    <i class="bi bi-pencil"></i>
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

@endsection

@section('footerSection')
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
