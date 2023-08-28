@extends('layouts.stilePdf')
@section('content')
<div style="display:flex">
    <div style="font-size: 14px">
        <img src="{{asset('storage/logo/logoAzienda.jpg')}}" style="width: 200px">
        <div>{{$configuration->nomeAzienda}}</div>
        <div>{{$configuration->indirizzoAzienda}}</div>
        <div>{{$configuration->capAzienda}} {{$configuration->cittaAzienda}} {{$configuration->provinciaAzienda}}</div>
        <div>p.iva: {{$configuration->pivaAzienda}}</div>
    </div>
    <div style="float: right; font-size: 14px">
        <div>Fattura nr.{{$fattura->progressivo}} del {{$fattura->created_at->format('d-m-Y')}}</div>
        <br>
        <div>{{$fattura->prova->client->nome}} {{$fattura->prova->client->cognome}}</div>
        <div>{{$fattura->prova->client->indirizzo}}</div>
        <div>{{$fattura->prova->client->cap}} {{$fattura->prova->client->citta}} {{$fattura->prova->client->provincia}}</div>
        <div>{{$fattura->prova->client->codfisc}}</div>
    </div>

</div>

<hr>

<br><br><br><br>

<div style="border: 1px solid black; height: 600px; width: 100%">
    <table style="width: 100%;">
        <tr>
            <td style="border-bottom: 1px solid black;width: 30%; background-color: #98ccf7">MATRICOLA</td>
            <td style="border-bottom: 1px solid black;width: 50%; background-color: #98ccf7">PRODOTTO</td>
            <td style="border-bottom: 1px solid black;width: 20%; background-color: #98ccf7">PREZZO</td>
        </tr>
        @foreach($fattura->prova->prodotti as $product)
            <tr>
                <td style="border-bottom: 1px solid black;width: 30%; padding: 5px">{{$product->matricola}}</td>
                <td style="border-bottom: 1px solid black;width: 50%; padding: 5px">{{$product->listino->nome}}</td>
                <td style="border-bottom: 1px solid black;width: 20%; padding: 5px">{{$product->listino->prezzo_formattato}}</td>
            </tr>
        @endforeach
    </table>
</div>


<table style="width: 100%;">
    <tr>
        <td style="border: 1px solid black;width: 33%; padding: 5px">Acconto: {{$fattura->acconto}}</td>
        <td style="border: 1px solid black;width: 34%; padding: 5px">Rate: {{$fattura->nr_rate}}</td>
        <td style="border: 1px solid black;width: 33%; padding: 5px">Tot: {{$fattura->prova->tot_formattato}}</td>
    </tr>
</table>

@endsection
