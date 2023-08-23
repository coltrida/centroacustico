@extends('layouts.stile')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Informazioni di {{$clientConListaInformazioniByIdClient->fullName}}</h1>
        <div>
            <a href="{{route('clienti', $clientConListaInformazioniByIdClient->filiale_id)}}" class="btn btn-warning">Indietro</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientConListaInformazioniByIdClient->informazioni as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                            <td class="text-nowrap">{{$item->tipo}}</td>
                            <td class="text-nowrap">{{$item->note}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="3">{{$clientConListaInformazioniByIdClient->informazioni->links()}}</td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
