@extends('layouts.stile')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pazienti di {{$filialeSelezionata->nome}}</h1>

            <div class="row">
                <div class="col-2">
                    <button type="submit" class="btn btn-primary"> Aggiungi</button>
                </div>
            </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">Action</th>
                        <th>Cognome</th>
                        <th>Nome</th>
                        <th>Telefono1</th>
                        <th>Telefono2</th>
                        <th>Indirizzo</th>
                        <th>Città</th>
                        <th>PR</th>
                        <th>email</th>
                        <th>Nascita</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($filialeSelezionata->clienti as $item)
                            <tr id="tr{{$item->id}}">
                                <td class="text-center">
                                    <a id="{{$item}}" title="elimina" class="btn btn-sm btn-danger eliminaBtn" href="#" data-toggle="modal" data-target="#confermaElimina">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </a>

                                    <a class="btn btn-primary btn-sm" title="modifica" href="#">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>

                                    <a class="btn btn-success btn-sm" title="prova" href="#">
                                        <i class="fas fa-fw fa-money-bill"></i>
                                    </a>

                                    <a class="btn btn-warning btn-sm" title="appuntamento" href="#">
                                        <i class="fas fa-fw fa-calendar"></i>
                                    </a>

                                    <a class="btn btn-sm" style="background: purple" title="audiometria" href="#">
                                        <i class="fas fa-fw fa-barcode"></i>
                                    </a>

                                    <a class="btn btn-sm" style="background: #96dbe4" title="pagamenti" href="#">
                                        <i class="fas fa-fw fa-dumbbell"></i>
                                    </a>

                                    <a class="btn btn-sm" style="background: #1c606a" title="riepilogo" href="#">
                                        <i class="fas fa-fw fa-info-circle"></i>
                                    </a>
                                </td>
                                <td>{{$item->cognome}}</td>
                                <td>{{$item->nome}}</td>
                                <td>{{$item->telefono1}}</td>
                                <td>{{$item->telefono2}}</td>
                                <td>{{$item->indirizzo}}</td>
                                <td>{{$item->citta}}</td>
                                <td>{{$item->provincia}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->dataNascita}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confermaElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conferma eliminazione <span id="userEliminaConferma"></span> ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <input type="hidden" id="UserDaEliminare">
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="formElimina" action="{{route('admin.deletePersonale')}}" method="post">
                        <a class="btn btn-danger confermaElimina" href="#" data-dismiss="modal">Conferma</a>
                    </form>
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

            $('tbody').on('click', '.eliminaBtn', function (evt) {
                evt.preventDefault();
                let UserElimina = JSON.parse(evt.currentTarget.id);
                $('#UserDaEliminare').val(UserElimina.id);
                $('#userEliminaConferma').html(UserElimina.nome);
            });

            $('.confermaElimina').on('click', function (evt) {
                evt.preventDefault();
                let userId = $('#UserDaEliminare').val()
                let form = $('#formElimina');
                let urlForm = form.attr('action')+'/'+userId;
                let tr = $('#tr' + userId);
                $.ajax(urlForm,
                    {
                        complete: function (resp) {
                            tr.remove();
                            $('#modal').modal('toggle');
                        }
                    }
                )
            });
        });
    </script>
@endsection
