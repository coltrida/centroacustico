@extends('layouts.stile2')
@section('content')
    <div class="container" style="padding-top: 70px">
        <div class="row text-center mt-5">
            <div class="col">
                <h3>Fatturato del Mese</h3>
                {{$userConProveFatturateNelMese->prove->count() > 0 ?
                                     '€ '.number_format( (float) $userConProveFatturateNelMese->prove->sum('tot'), '0', ',', '.') : 0}}
            </div>
            <div class="col">
                <h3>Fatturato Anno</h3>
                {{$fatturatoAnno ? '€ '.number_format( (float) $fatturatoAnno, '0', ',', '.') : 0}}
            </div>
        </div>

        <div class="row text-center mt-5">
            <div class="col-12 col-sm-5">
                <div class="card shadow mb-4">
                    <div class="card-body rounded" style="background: dimgrey;">
                <h3 class="mt-4">Prove in Corso</h3>
                <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        <td>Paziente</td>
                        <th>Data</th>
                        <th>Tot</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userConProveInCorso->prove as $item)
                        <tr>
                            <td>
                                <a style="text-decoration: none" href="{{route('ricercaPazienteById', $item->client_id)}}">
                                    {{$item->client->fullName}}
                                </a>
                            </td>
                            <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                            <td class="text-nowrap">{{$item->tot_formattato}}</td>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><b>Totale</b></td>
                        <td></td>
                        <td>
                            <b>
                                {{$userConProveInCorso->prove->count() > 0 ?
                                     '€ '.number_format( (float) $userConProveInCorso->prove->sum('tot'), '0', ',', '.') : 0}}
                            </b>
                        </td>
                    </tr>
                    </tbody>
                </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-5">
                <div class="card shadow mb-4">
                    <div class="card-body rounded" style="background: dimgrey;">
                <h3 class="mt-4">Fatturato del Mese</h3>
                <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        <td>Paziente</td>
                        <th>Data</th>
                        <th>Tot</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userConProveFatturateNelMese->prove as $item)
                        <tr>
                            <td>
                                <a style="text-decoration: none" href="{{route('ricercaPazienteById', $item->client_id)}}">
                                    {{$item->client->fullName}}
                                </a>
                            </td>
                            <td class="text-nowrap">{{\Carbon\Carbon::make($item->fine_prova)->format('d-m-Y')}}</td>
                            <td class="text-nowrap">{{$item->tot_formattato}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-2">
                <div class="card shadow mb-4">
                    <div class="card-body rounded" style="background: dimgrey;">
                <h3 class="mt-4">Tel. di oggi</h3>
                <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                    <thead class="table-light">
                    <tr>
                        <td>Paziente</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userConProveInCorso->prove as $item)
                        <tr>
                            <td>{{$item->client->fullName}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

