@extends('layouts.stile2')
@section('content')

    <div class="container pt-4">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Categorie</h1>
            <form action="{{route('admin.aggiungiCategoria')}}" method="post">
                @csrf
                <div class="row ml-4">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nome Categoria" aria-label="First name"
                               name="nome">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary"> Aggiungi</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-6">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped nowrap" id="dataTable" width="100%"
                           cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categorie as $item)
                            <tr>
                                <td class="text-nowrap">{{$item->nome}}</td>
                                <td class="text-nowrap text-center">
                                    <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                       href="#">
                                        <i class="bi bi-trash"></i>
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

