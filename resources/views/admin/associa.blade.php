@extends('layouts.stile')
@section('content')
    <div class="container-fluid">

        <form action="" method="post">
            @csrf

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Associa Filiale - Personale</h1>

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
                                <input class="form-check-input" type="radio" name="filiale_id" value="{{$item->id}}">
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
                                <input class="form-check-input" type="checkbox" value="{{$item->id}}" name="user[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$item->nome}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Third Column -->
            <div class="col-lg-4">

                <!-- Grayscale Utilities -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Custom Grayscale Background Utilities
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-gray-100">.bg-gray-100</div>
                        <div class="p-3 bg-gray-200">.bg-gray-200</div>
                        <div class="p-3 bg-gray-300">.bg-gray-300</div>
                        <div class="p-3 bg-gray-400">.bg-gray-400</div>
                        <div class="p-3 bg-gray-500 text-white">.bg-gray-500</div>
                        <div class="p-3 bg-gray-600 text-white">.bg-gray-600</div>
                        <div class="p-3 bg-gray-700 text-white">.bg-gray-700</div>
                        <div class="p-3 bg-gray-800 text-white">.bg-gray-800</div>
                        <div class="p-3 bg-gray-900 text-white">.bg-gray-900</div>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
