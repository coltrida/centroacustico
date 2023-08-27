@extends('layouts.stile2')
@section('content')
    <div class="container pt-4">
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

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Magazzino {{$filiale->nome}}</h1>
        <div class="row ml-4">
            <livewire:live-top-magazzino :idFiliale="$idFiliale"/>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body rounded" style="background: dimgrey;">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{$menu1}}" href="{{route('magazzino', $filiale->id)}}">In Magazzino</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$menu2}}" href="{{route('prodottiInProva', $filiale->id)}}">In Prova</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$menu3}}" href="{{route('prodottiRichiesti', $filiale->id)}}">Richiesti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$menu4}}" href="{{route('prodottiInArrivo', $filiale->id)}}">In Arrivo</a>
                </li>
            </ul>

            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped nowrap" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        @if(count($prodotti) > 0 && $prodotti[0]->stato->nome != 'RICHIESTO')
                            <th>Matricola</th>
                        @endif
                        <th>Nome</th>
                        <th>Fornitore</th>
                        <th>Categoria</th>
                        @if(count($prodotti) > 0 && $prodotti[0]->stato->nome != 'SPEDITO')
                            <th>Data Carico</th>
                        @endif
                        @if(count($prodotti) > 0 && $prodotti[0]->stato->nome == 'RICHIESTO')
                            <th>Data Richiesta</th>
                        @endif
                        @if(count($prodotti) > 0 && $prodotti[0]->stato->nome == 'PROVA IN CORSO')
                            <th>Paziente</th>
                        @endif
                        @if(count($prodotti) > 0 && $prodotti[0]->stato->nome == 'SPEDITO')
                            <th>ACTION</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($prodotti as $item)
                        <tr>
                            @if(count($prodotti) > 0 && $prodotti[0]->stato->nome != 'RICHIESTO')
                                <td class="text-nowrap">{{$item->matricola}}</td>
                            @endif
                            <td class="text-nowrap">{{$item->listino->nome}}</td>
                            <td class="text-nowrap">{{$item->listino->fornitore->nome}}</td>
                            <td class="text-nowrap">{{$item->listino->categoria->nome}}</td>
                            @if(count($prodotti) > 0 && $prodotti[0]->stato->nome != 'SPEDITO')
                                <td class="text-nowrap">{{$item->datacarico}}</td>
                            @endif
                            @if(count($prodotti) > 0 && $prodotti[0]->stato->nome == 'RICHIESTO')
                                <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                            @endif
                            @if(count($prodotti) > 0 && $prodotti[0]->stato->nome == 'PROVA IN CORSO')
                                <td class="text-nowrap">{{$item->prova_id ? $item->prova->client->fullName : ''}}</td>
                            @endif
                            @if(count($prodotti) > 0 && $prodotti[0]->stato->nome == 'SPEDITO')
                                <td>
                                    <a id="{{$item}}" title="arrivato" class="btn btn-sm btn-success mx-1"
                                       href="{{route('switchProdottoInMagazzino', $item->id)}}">
                                        <i class="bi bi-truck"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">{{$prodotti->links()}}</td>
                    </tr>
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
                $('#exampleModal').modal();
                setTimeout(function () {
                    $('#exampleModal').modal('hide');
                }, 3000);
            }
        });
    </script>
@endsection
