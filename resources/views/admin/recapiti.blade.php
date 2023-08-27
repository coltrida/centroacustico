@extends('layouts.stile2')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container pt-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Recapiti</h1>
        <form action="{{route('admin.aggiungiRecapito')}}" method="post">
            @csrf
            <div class="row ml-3">
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Nome Recapito" aria-label="First name"
                           name="nome">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Indirizzo" aria-label="Last name"
                           name="indirizzo">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Città" aria-label="Last name" name="citta">
                </div>
                <div class="col-1">
                    <input type="text" class="form-control" placeholder="PR" aria-label="Last name" name="provincia">
                </div>
                <div class="col-2">
                    <select class="form-select" name="filiale_id" aria-label="Default select example" name="ruolo_id">
                        <option selected>filiale...</option>
                        @foreach($filiali as $filiale)
                            <option value="{{$filiale->id}}">{{$filiale->nome}}</option>
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

        <div class="card-body rounded" style="background: dimgrey;">
            <div class="table-responsive">
                <table class="table table-bordered py-4" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Indirizzo</th>
                        <th>Città</th>
                        <th>Provincia</th>
                        <th>Filiale</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($recapiti as $recapito)
                        <tr id="tr{{$recapito->id}}">
                            <td>{{$recapito->nome}}</td>
                            <td>{{$recapito->indirizzo}}</td>
                            <td>{{$recapito->citta}}</td>
                            <td>{{$recapito->provincia}}</td>
                            <td>{{$recapito->filiale->nome}}</td>
                            <td>
                                {{--<a id="{{$recapito}}" title="elimina" class="btn btn-danger eliminaBtn" href="#"
                                   data-toggle="modal" data-target="#confermaElimina">
                                    <i class="bi bi-trash"></i>
                                </a>--}}
                                <button id="{{$recapito}}" type="button"
                                        title="elimina"
                                        class="btn btn-danger eliminaBtn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confermaElimina">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <a class="btn btn-primary" href="#" title="modifica">
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

    <div class="modal fade" id="confermaElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conferma eliminazione <span
                            id="recapitoEliminaConferma"></span> ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="formElimina" action="{{route('admin.eliminaRecapito')}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" id="recapitoDaEliminare" name="recapitoDaEliminare">
                        <button class="btn btn-danger" type="submit" data-bs-dismiss="modal">Conferma</button>
                    </form>
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

            $('tbody').on('click', '.eliminaBtn', function (evt) {
                evt.preventDefault();
                let recapitoElimina = JSON.parse(evt.currentTarget.id);
                $('#recapitoDaEliminare').val(recapitoElimina.id);
                $('#recapitoEliminaConferma').html(recapitoElimina.nome);
            });

            /*$('.confermaElimina').on('click', function (evt) {
                evt.preventDefault();
                let userId = $('#UserDaEliminare').val()
                let form = $('#formElimina');
                let urlForm = form.attr('action') + '/' + userId;
                let tr = $('#tr' + userId);
                $.ajax(urlForm,
                    {
                        complete: function (resp) {
                            tr.remove();
                            $('#modal').modal('toggle');
                        }
                    }
                )
            });*/
        });
    </script>
@endsection
