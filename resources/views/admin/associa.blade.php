@extends('layouts.stile2')
@section('content')
    <div class="container py-4">
        <form action="{{route('admin.eseguiAssocia')}}" method="post">
            @csrf

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Associa Filiale - Personale</h1>

                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary"> Associa</button>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- First Column -->
                <div class="col-lg-4">

                    <!-- Custom Text Color Utilities -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Filiali</h6>
                        </div>
                        <div class="card-body">
                            @foreach($filiali as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filiale_id"
                                           value="{{$item->id}}">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{$item->nome}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-lg-4">

                    <!-- Background Gradient Utilities -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Personale</h6>
                        </div>
                        <div class="card-body">
                            @foreach($personale as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$item->id}}"
                                           name="users[]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{$item->nome}} ({{$item->ruolo->nome}})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Third Column -->
                <div class="col-lg-4">

                    <!-- Grayscale Utilities -->

                    @foreach($filiali as $item)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{$item->nome}}</h6>
                            </div>
                            <div class="card-body">
                                @foreach($item->users as $user)
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        <div class="p-3">{{$user->nome}} ({{$user->ruolo->nome}})</div>
                                        <div>
                                            <a href="{{route('admin.eliminaAssociazione', $user->pivot->id)}}">
                                                <i style="color: red" class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{--<div class="card-body">
                        <div class="p-3 bg-gray-100">.bg-gray-100</div>
                        <div class="p-3 bg-gray-200">.bg-gray-200</div>
                        <div class="p-3 bg-gray-300">.bg-gray-300</div>
                        <div class="p-3 bg-gray-400">.bg-gray-400</div>
                        <div class="p-3 bg-gray-500 text-white">.bg-gray-500</div>
                        <div class="p-3 bg-gray-600 text-white">.bg-gray-600</div>
                        <div class="p-3 bg-gray-700 text-white">.bg-gray-700</div>
                        <div class="p-3 bg-gray-800 text-white">.bg-gray-800</div>
                        <div class="p-3 bg-gray-900 text-white">.bg-gray-900</div>
                    </div>--}}

                </div>

            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
