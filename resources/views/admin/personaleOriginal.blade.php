@extends('layouts.stile')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Personale</h1>
        <form action="{{route('admin.aggiungiPersonale')}}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nome e Cognome" aria-label="First name"
                           name="nome">
                </div>
                <div class="col">
                    <input type="email" class="form-control" placeholder="email" aria-label="Last name"
                           name="email">
                </div>
                <div class="col">
                    <select class="form-control" aria-label="Default select example" name="ruolo_id">
                        <option selected></option>
                        @foreach($ruoli as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
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
                        <th>email</th>
                        <th>Ruolo</th>
                        <th class="text-center">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach($personale as $item)
                            <tr>
                                <td>{{$item->nome}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->ruolo->nome}}</td>
                                <td class="text-center">
                                    <form action="{{route('admin.deletePersonale', $item->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        {{--<button type="submit" class="bnt btn-danger" title="elimina">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </button>--}}

                                        <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#confermaElimina">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confermaElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conferma eliminazione?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
