@extends('layouts.stile2')
@section('content')

    <div class="container" style="padding-top: 100px">

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
        <h1 class="h3 mb-0 text-gray-800 text-white">Pazienti
            di {{isset($filialeSelezionata->nome) ? $filialeSelezionata->nome : $filialeSelezionata}}</h1>

        <div class="row">
            <div class="col-2">
                <a href="{{route('aggiungiModificaCliente', ['idFiliale' => isset($filialeSelezionata->id) ? $filialeSelezionata->id : null, 'idClient' => null])}}"
                   class="btn btn-primary"> Aggiungi</a>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body rounded" style="background: dimgrey;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                    <form action="{{route('ricercaPaziente')}}" method="get">
                        <input type="hidden" name="idFiliale"
                               value="{{isset($filialeSelezionata->id) ? $filialeSelezionata->id : null}}">
                        <div class="row mb-3">
                            <div class="col-9 col-md-3">
                                <input type="text" value="{{isset($testo) ? $testo : ''}}" name="testoRicerca"
                                       class="form-control"
                                       placeholder="Ricerca Nome / Cognome" aria-label="First name">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                                <a class="btn btn-warning"
                                   href="{{route('clienti', isset($filialeSelezionata->id) ? $filialeSelezionata->id : null)}}">Reset</a>
                            </div>
                        </div>
                    </form>
                    <thead class="table-light">
                    <tr>
                        <th class="text-center" style="min-width: 200px">Action</th>
                        <th style="min-width: 100px">Tipo</th>
                        <th style="min-width: 150px">Cognome</th>
                        <th style="min-width: 150px">Nome</th>
                        <th style="min-width: 170px">Telefono1</th>
                        <th style="min-width: 170px">Telefono2</th>
                        <th style="min-width: 320px">Indirizzo</th>
                        <th style="min-width: 170px">Città</th>
                        <th>PR</th>
                        <th>email</th>
                        <th>Canale Mkt</th>
                        <th>Recapito</th>
                        <th class="text-nowrap">Data Nascita</th>
                        <th class="text-nowrap">Data Creazione</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pazienti as $item)
                        <tr id="tr{{$item->id}}">
                            <td class="text-center d-flex">
                                {{--<a id="{{$item}}" title="elimina" class="btn btn-sm btn-danger eliminaBtn mx-1" href="#" data-toggle="modal" data-target="#confermaElimina">
                                    <i class="fas fa-fw fa-trash"></i>
                                </a>--}}

                                <a class="btn btn-primary btn-sm mx-1" title="modifica"
                                   href="{{route('aggiungiModificaCliente',
                                            ['idFiliale' => $item->filiale_id, 'idClient' => $item])}}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a class="btn btn-success btn-sm mx-1" title="prova"
                                   href="{{route('prova', $item->id)}}">
                                    <i class="bi bi-earbuds"></i>
                                </a>

                                <a class="btn btn-warning btn-sm mx-1" title="appuntamento"
                                   href="{{route('appuntamenti', $item->id)}}">
                                    <i class="bi bi-calendar3"></i>
                                </a>

                                <a class="btn btn-sm mx-1" style="background: #223264" title="telefonata"
                                   href="{{route('telefonata', $item->id)}}">
                                    <i class="bi bi-telephone"></i>
                                </a>

                                <a class="btn btn-sm mx-1" style="background: purple" title="audiometria"
                                   href="{{route('audiometrie', $item->id)}}">
                                    <i class="bi bi-graph-down"></i>
                                </a>

                                <a class="btn btn-sm mx-1" style="background: #739a0d" title="pagamenti" href="#">
                                    <i class="bi bi-credit-card"></i>
                                </a>

                                <a class="btn btn-sm mx-1" style="background: #1c606a" title="Informazioni"
                                   href="{{route('informazioni', $item->id)}}">
                                    <i class="bi bi-info-circle"></i>
                                </a>
                            </td>
                            <td class="text-nowrap">{{$item->tipo ? $item->tipo->nome : ''}}</td>
                            <td class="text-nowrap">{{$item->cognome}}</td>
                            <td class="text-nowrap">{{$item->nome}}</td>
                            <td class="text-nowrap">{{$item->telefono1}}</td>
                            <td class="text-nowrap">{{$item->telefono2}}</td>
                            <td class="text-nowrap">{{$item->indirizzo}}</td>
                            <td class="text-nowrap">{{$item->citta}}</td>
                            <td class="text-nowrap">{{$item->provincia}}</td>
                            <td class="text-nowrap">{{$item->email}}</td>
                            <td class="text-nowrap">{{$item->canale ? $item->canale->nome : ''}}</td>
                            <td class="text-nowrap">{{$item->recapito_id ? $item->recapito->nome : ''}}</td>
                            <td class="text-nowrap">{{$item->dataNascitaFormattata}}</td>
                            <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                        </tr>
                    @endforeach

                    <td colspan="14">{{$pazienti->links()}}</td>

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
                            id="userEliminaConferma"></span> ?</h5>
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
