@extends('layouts.stile')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pazienti di {{isset($filialeSelezionata->nome) ? $filialeSelezionata->nome : $filialeSelezionata}}</h1>

            <div class="row">
                <div class="col-2">
                    <a href="{{route('aggiungiCliente', $filialeSelezionata->id)}}" class="btn btn-primary"> Aggiungi</a>
                </div>
            </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                    <form action="{{route('ricercaPaziente')}}" method="get">
                        <input type="hidden" name="idFiliale" value="{{isset($filialeSelezionata->id) ? $filialeSelezionata->id : null}}">
                        <div class="row mb-3">
                            <div class="col-9 col-md-3">
                                <input type="text" value="{{isset($testo) ? $testo : ''}}" name="testoRicerca" class="form-control"
                                       placeholder="Ricerca Nome / Cognome" aria-label="First name">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-sm"></i></button>
                                <a class="btn btn-warning" href="{{route('clienti', isset($filialeSelezionata->id) ? $filialeSelezionata->id : null)}}">Reset</a>
                            </div>
                        </div>
                    </form>
                    <thead>
                    <tr>
                        <th class="text-center">Action</th>
                        <th>Tipo</th>
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
                        @foreach($pazienti as $item)
                            <tr id="tr{{$item->id}}">
                                <td class="text-center d-flex">
                                    <a id="{{$item}}" title="elimina" class="btn btn-sm btn-danger eliminaBtn mx-1" href="#" data-toggle="modal" data-target="#confermaElimina">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </a>

                                    <a class="btn btn-primary btn-sm mx-1" title="modifica" href="#">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>

                                    <a class="btn btn-success btn-sm mx-1" title="prova" href="#">
                                        <i class="fas fa-fw fa-money-bill"></i>
                                    </a>

                                    <a class="btn btn-warning btn-sm mx-1" title="appuntamento" href="#">
                                        <i class="fas fa-fw fa-calendar"></i>
                                    </a>

                                    <a class="btn btn-sm mx-1" style="background: purple" title="audiometria" href="#">
                                        <i class="fas fa-fw fa-barcode"></i>
                                    </a>

                                    <a class="btn btn-sm mx-1" style="background: #96dbe4" title="pagamenti" href="#">
                                        <i class="fas fa-fw fa-dumbbell"></i>
                                    </a>

                                    <a class="btn btn-sm mx-1" style="background: #1c606a" title="riepilogo" href="#">
                                        <i class="fas fa-fw fa-info-circle"></i>
                                    </a>
                                </td>
                                <td class="text-nowrap">{{$item->tipo->nome}}</td>
                                <td class="text-nowrap">{{$item->cognome}}</td>
                                <td class="text-nowrap">{{$item->nome}}</td>
                                <td class="text-nowrap">{{$item->telefono1}}</td>
                                <td class="text-nowrap">{{$item->telefono2}}</td>
                                <td class="text-nowrap">{{$item->indirizzo}}</td>
                                <td class="text-nowrap">{{$item->citta}}</td>
                                <td class="text-nowrap">{{$item->provincia}}</td>
                                <td class="text-nowrap">{{$item->email}}</td>
                                <td class="text-nowrap">{{$item->dataNascita}}</td>
                            </tr>
                        @endforeach

                    <td colspan="10">{{$pazienti->links()}}</td>

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
