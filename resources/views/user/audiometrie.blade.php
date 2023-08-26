@extends('layouts.stile')
@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4 class="mb-0 text-gray-800">Audiometria di {{$clientConAudiometrieByIdClient->fullName}}
            del {{$audiometria->created_at->format('d-m-Y')}}</h4>
        <div>
            <a class="btn btn-warning" href="{{ route('clienti', $clientConAudiometrieByIdClient->filiale_id) }}">
                Indietro</a>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    {{--                    <h6 class="m-0 font-weight-bold text-primary">Audiometria di {{$clientConAudiometrieByIdClient->fullName}} del {{$audiometria->created_at->format('d-m-Y')}}</h6>--}}
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                             aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>

                <div id="audiom" style="display: none">{{$audiometria}}</div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Audiometrie Passate</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                             aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div>
                        @foreach($clientConAudiometrieByIdClient->audiometrie as $item)
                            <a href="{{route('audiometrie',
                                ['idClient' => $clientConAudiometrieByIdClient->id, 'idAudiometria' => $item->id])}}"
                               class="btn {{$item->created_at == $audiometria->created_at ? 'btn-success' : 'btn-primary'}}">
                                {{$item->created_at->format('d-m-Y')}}
                            </a>
                        @endforeach
                    </div>
                    {{--                    {{$audiometria}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('js/audiometria.js')}}"></script>
@endsection
