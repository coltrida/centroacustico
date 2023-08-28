@extends('layouts.stile2')
@section('content')

    <div id="myCarousel" class="carousel slide mb-6" >
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" >
                <svg class="bd-placeholder-img"
                     width="100%" height="100%"
                     xmlns="http://www.w3.org/2000/svg"
                     aria-hidden="true"
                     preserveAspectRatio="xMidYMid slice"
                     focusable="false">
                    <rect width="100%" height="100%" fill="white"/>
                </svg>
                <div class="container" >
                    <div class="carousel-caption text-start">
                        <div class="row mb-5">
                            <div class="col">
                                <h1>Fatturato del Mese</h1>
                                <div class="card shadow">
                                    <div class="card-body rounded p-3" style="background: dimgrey;">
                                        <div class="table-responsive">
                                            <table class="table table-sm mt-2 table-bordered table-striped nowrap" width="100%" cellspacing="0">
                                                <thead class="table-light">
                                                <tr>
                                                    <td style="width: 70%">Tot</td>
                                                    <th class="text-center">
                                                        {{$userConProveFatturateNelMese->prove->count() > 0 ?
                                                    '€ '.number_format( (float) $userConProveFatturateNelMese->prove->sum('tot'), '0', ',', '.') :
                                                        0}}
                                                    </th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h1>Fatturato Annuo</h1>
                                <div class="card shadow">
                                    <div class="card-body rounded p-3" style="background: dimgrey;">
                                        <div class="table-responsive">
                                            <table class="table table-sm mt-2 table-bordered table-striped nowrap" width="100%" cellspacing="0">
                                                <thead class="table-light">
                                                <tr>
                                                    <td style="width: 70%">Tot</td>
                                                    <th class="text-center">
                                                        {{$fatturatoAnno ?
                                                    '€ '.number_format( (float) $fatturatoAnno, '0', ',', '.') :
                                                        0}}
                                                    </th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1>Prove In Corso</h1>
                        <div class="card shadow mb-5">
                            <div class="card-body rounded p-3" style="background: dimgrey;">
                                <div class="table-responsive">
                                    <table class="table table-sm mt-2 table-bordered table-striped nowrap" width="100%" cellspacing="0">
                                        <thead class="table-light">
                                        <tr>
                                            <td>Paziente</td>
                                            <th>Data</th>
                                            <th>Tot</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($userConProveInCorso->prove as $item)
                                            <tr>
                                                <td>{{$item->client->fullName}}</td>
                                                <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                                                <td class="text-nowrap">{{$item->tot}}</td>
                                                <td class="text-nowrap text-center">
                                                    <button title="Informazioni"
                                                            wire:click="vediDettagliProva({{$item->id}})"
                                                            type="button"
                                                            class="btn btn-primary btn-sm mx-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#infoProva">
                                                        <i class="bi bi-info-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="white"/></svg>
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Fatturato del Mese</h1>
                        <div class="card shadow" style="margin-bottom: 100px">
                            <div class="card-body rounded p-3" style="background: dimgrey;">
                                <div class="table-responsive">
                                    <table class="table table-sm mt-2 table-bordered table-striped nowrap" width="100%" cellspacing="0">
                                        <thead class="table-light">
                                        <tr>
                                            <td>Paziente</td>
                                            <th>Data</th>
                                            <th>Tot</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($userConProveFatturateNelMese->prove as $item)
                                            <tr>
                                                <td>{{$item->client->fullName}}</td>
                                                <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                                                <td class="text-nowrap">{{$item->tot}}</td>
                                                <td class="text-nowrap text-center">
                                                    <button title="Informazioni"
                                                            wire:click="vediDettagliProva({{$item->id}})"
                                                            type="button"
                                                            class="btn btn-primary btn-sm mx-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#infoProva">
                                                        <i class="bi bi-info-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="white"/></svg>
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Telefonate del giorno</h1>
                        <div class="card shadow" style="margin-bottom: 100px">
                            <div class="card-body rounded p-3" style="background: dimgrey;">
                                <div class="table-responsive">
                                    <table class="table table-sm mt-2 table-bordered table-striped nowrap" width="100%" cellspacing="0">
                                        <thead class="table-light">
                                        <tr>
                                            <td>Paziente</td>
                                            <th>Data</th>
                                            <th>Tot</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($userConProveFatturateNelMese->prove as $item)
                                            <tr>
                                                <td>{{$item->client->fullName}}</td>
                                                <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                                                <td class="text-nowrap">{{$item->tot}}</td>
                                                <td class="text-nowrap text-center">
                                                    <button title="Informazioni"
                                                            wire:click="vediDettagliProva({{$item->id}})"
                                                            type="button"
                                                            class="btn btn-primary btn-sm mx-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#infoProva">
                                                        <i class="bi bi-info-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection

