@extends('layouts.stile')
@section('headSection')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
@endsection
@section('content')
    <livewire:live-aggiungi-cliente :idFiliale="$idFiliale" :idClient="$idClient"/>
@endsection
