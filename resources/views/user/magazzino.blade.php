@extends('layouts.stile')

@section('headSection')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Magazzino {{$filiale->nome}}</h1>
        <div class="row ml-4">
            <livewire:live-top-magazzino :idFiliale="$idFiliale"/>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{$menu1}}"  href="{{route('magazzino', $filiale->id)}}">In Magazzino</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$menu2}}"  href="{{route('prodottiInProva', $filiale->id)}}">In Prova</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$menu3}}"  href="{{route('prodottiRichiesti', $filiale->id)}}">Richiesti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$menu4}}"  href="{{route('prodottiInArrivo', $filiale->id)}}">In Arrivo</a>
                </li>
            </ul>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped nowrap"  width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>stato</th>
                            <th>Matricola</th>
                            <th>Nome</th>
                            <th>Fornitore</th>
                            <th>Categoria</th>
                            <th>Data Carico</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prodotti as $item)
                            <tr>
                                <td class="text-nowrap">{{$item->stato_id}}</td>
                                <td class="text-nowrap">{{$item->matricola}}</td>
                                <td class="text-nowrap">{{$item->listino->nome}}</td>
                                <td class="text-nowrap">{{$item->listino->fornitore->nome}}</td>
                                <td class="text-nowrap">{{$item->listino->categoria->nome}}</td>
                                <td class="text-nowrap">{{$item->datacarico}}</td>
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

@endsection

@section('footerSection')
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
