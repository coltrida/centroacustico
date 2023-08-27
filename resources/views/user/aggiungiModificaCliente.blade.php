@extends('layouts.stile2')
@section('content')
    <div class="container pt-4">
        <livewire:live-aggiungi-cliente :idFiliale="$idFiliale" :idClient="$idClient"/>
    </div>
@endsection
