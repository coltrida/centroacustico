@extends('layouts.stile2')
@section('content')
    <div class="container pt-4 pb-5">
        <livewire:live-appuntamento :idClient="$idClient"/>
    </div>
@endsection

