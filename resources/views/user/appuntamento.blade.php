@extends('layouts.stile')
@section('content')
    <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Appuntamenti {{$userConAppuntamenti->fullName}}</h1>
    </div>

    <form action="{{route('telefonataEffettuata')}}" method="post">
        @csrf
        <input type="hidden" name="client_id" value="{{$userConAppuntamenti->id}}">
    <div class="d-flex mb-4">
        <div class="col">
            <label class="form-label">Data Appuntamento</label>
            <input type="date" class="form-control" aria-label="First name" name="">
        </div>
        <div class="col">
            <label class="form-label">Tipo Appuntamento</label>
            <select class="form-control" aria-label="Default select example" name="esito">
                <option selected></option>
                <option>Assistenza</option>
                <option>Prima Visita</option>
                <option>Consegna Apa</option>
            </select>
        </div>
        <div class="col">
            <label for="exampleFormControlTextarea1" class="form-label">Note</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="note"></textarea>
        </div>

        <div class="col">
            <label for="exampleFormControlTextarea1" class="form-label">&nbsp;</label> <br>
            <button type="submit" class="btn btn-primary"> Inserisci</button>
            <a type="submit" class="btn btn-warning" href="{{ URL::previous() }}"> Indietro</a>
        </div>
    </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex flex-row-reverse">
                <div class="btn-group" role="group" aria-label="Default button group">
                    <button type="button" class="btn btn-outline-primary">Indietro</button>
                    <button type="button" class="btn btn-outline-primary">Avanti</button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="list-group col-1">
                    <br>
                    @for($ora=9; $ora < 19; $ora++)
                        <div class="list-group-item list-group-item-dark"
                           style="font-size: 14px; padding: 0.4rem 0.2rem">
                            {{$ora == 9 ? '0'.$ora.':00-'.($ora+1).':00' : $ora.':00-'.($ora+1).':00'}}
                        </div>
                    @endfor
                </div>
                @for($giorno=0; $giorno < 6; $giorno++)

                    <div class="list-group col">
                        <span class="text-center">{{$nomeGiorno[$giorno]}}</span>
                        @for($ora=9; $ora < 19; $ora++)
                        <a href="#" class="list-group-item list-group-item-action text-center list-group-item-secondary"
                           style="font-size: 14px; padding: 0.4rem 0.2rem">A simple default list</a>
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
     <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
     <script>
         $('document').ready(function () {
             let mess = "{{Session::has('message')}}"
             if(mess){
                 $('#info').modal();
                 setTimeout(function () {
                     $('#info').modal('hide');
                 }, 2000);
             }
         });
     </script>
@endsection
