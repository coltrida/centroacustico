@extends('layouts.stile2')
@section('content')

    <div class="container pt-4">

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    </div>
                    <div class="modal-body">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Canali Mkt</h1>
        <form action="{{route('admin.aggiungiCanale')}}" method="post">
            @csrf
            <div class="row ml-4">
                <div class="col-8">
                    <input type="text" class="form-control" placeholder="Nome Canale" aria-label="First name"
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
                <table class="table table-bordered table-striped nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($canali as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->nome}}</td>
                            <td class="text-nowrap text-center">
                                <a class="btn btn-danger btn-sm mx-1" title="elimina"
                                   href="{{route('admin.eliminaCanale', $item->id)}}">
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

@section('footerSection')
    <script>
        $('document').ready(function () {
            let mess = "{{Session::has('message')}}"
            if (mess) {
                const myModal = new bootstrap.Modal('#exampleModal')
                myModal.show();
                setTimeout(function () {
                    myModal.hide();
                }, 3000);
            }
        });
    </script>
@endsection
