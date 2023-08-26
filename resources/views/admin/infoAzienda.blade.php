@extends('layouts.stile')
@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Info</h4>
                </div>
                <div class="modal-body">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <h1>Informazioni Azienda</h1>
            </div>

            <form action="{{route('admin.modificaInfoAzienda')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="mt-8 mb-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-4">
                    <div class="row">
                        <div class="p-6 col">
                            <div class="flex items-center mb-2">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="#" class="underline text-gray-900 dark:text-white">
                                        Anagrafica Azienda
                                    </a>
                                </div>
                            </div>

                            <div class="ml-1 mb-3">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nome Azienda</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nomeAzienda" class="form-control" value="{{$configurazione->nomeAzienda}}"
                                               placeholder="Nome Azienda" aria-label="First name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Indirizzo</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="indirizzoAzienda" class="form-control" value="{{$configurazione->indirizzoAzienda}}"
                                               placeholder="indirizzoAzienda" aria-label="First name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Città</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cittaAzienda" class="form-control" value="{{$configurazione->cittaAzienda}}"
                                               placeholder="citta Azienda" aria-label="First name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Provincia</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="provinciaAzienda" class="form-control" value="{{$configurazione->provinciaAzienda}}"
                                               placeholder="provincia Azienda" aria-label="First name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">p. iva</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pivaAzienda" class="form-control" value="{{$configurazione->pivaAzienda}}"
                                               placeholder="piva Azienda" aria-label="First name">
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-3 ml-4 text-lg leading-7 font-semibold">
                                    <a  class="underline text-gray-900 dark:text-white">
                                        Logo Azienda
                                    </a>
                                </div>
                                <div class="col mb-3">
                                    <img src="{{asset('storage/logo/logoAzienda.jpg')}}">
                                </div>
                            </div>
                        </div>

                        <div class="p-6 col">
                            <div class="flex items-center mb-2">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="#" class="underline text-gray-900 dark:text-white">
                                        Contatti Azienda
                                    </a>
                                </div>
                            </div>

                            <div class="ml-1 mb-4">
                                <div class="row mb-3">
                                    <label for="emailAzienda" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emailAzienda" class="form-control" value="{{$configurazione->emailAzienda}}"
                                               placeholder="email Azienda" aria-label="First name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="pecAzienda" class="col-sm-3 col-form-label">pec Azienda</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pecAzienda" class="form-control" value="{{$configurazione->pecAzienda}}"
                                               placeholder="pec Azienda" aria-label="First name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="telefonoAzienda" class="col-sm-3 col-form-label">telefono Azienda</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telefonoAzienda" class="form-control" value="{{$configurazione->telefonoAzienda}}"
                                               placeholder="pec Azienda" aria-label="First name">
                                    </div>
                                </div>
                            </div>


                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="#" class="underline text-gray-900 dark:text-white">
                                        Magazzino Centralizzato
                                    </a>
                                </div>
                            </div>


                            <div class="ml-1 mb-3">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="magazzinoCentralizzato"
                                               id="flexRadioDefault1" value='1' {{$configurazione->magazzinoCentralizzato == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Magazzino centrale + magazzini delle filiali
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="magazzinoCentralizzato"
                                               id="flexRadioDefault2" value='0' {{$configurazione->magazzinoCentralizzato == 0 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Solo magazzini decentralizzati delle filiali
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3"> Modifica</button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">

                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    {{env('APP_NAME')}}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footerSection')
    <script>
        $('document').ready(function () {
            let mess = "{{Session::has('message')}}"
            if(mess){
                $('#exampleModal').modal();
                setTimeout(function () {
                    $('#exampleModal').modal('hide');
                }, 3000);
            }
        });
    </script>
@endsection
