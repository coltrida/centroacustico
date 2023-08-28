@extends('layouts.stile2')
@section('content')
    <div class="container pt-4">
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
        <h1 class="h3 mb-0 text-gray-800">Telefonate {{$userConTelefonate->fullName}}</h1>
    </div>

    <form action="{{route('telefonataEffettuata')}}" method="post">
        @csrf
        <input type="hidden" name="client_id" value="{{$userConTelefonate->id}}">
        <div class="d-flex mb-4">
            <div class="col">
                <label class="form-label">Esito</label>
                <select class="form-control" aria-label="Default select example" name="esito">
                    <option selected></option>
                    <option>Preso Appuntamento</option>
                    <option>Non interessato</option>
                    <option>Non Risponde</option>
                </select>
            </div>
            <div class="col">
                <label for="exampleFormControlTextarea1" class="form-label">Note</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="note"></textarea>
            </div>

            <div class="col">
                <label for="exampleFormControlTextarea1" class="form-label">&nbsp;</label> <br>
                <button type="submit" class="btn btn-primary"> Inserisci</button>
                <a type="submit" class="btn btn-warning" href="{{ route('clienti', $userConTelefonate->filiale_id) }}"> Indietro</a>
            </div>
        </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped nowrap" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Data Telefonata</th>
                        <th>Esito</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userConTelefonate->telefonate as $item)
                        <tr>
                            <td class="text-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                            <td class="text-nowrap">{{$item->esito}}</td>
                            <td class="text-nowrap">{{$item->note}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">{{$userConTelefonate->telefonate->links()}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('document').ready(function () {
            let mess = "{{Session::has('message')}}"
            if (mess) {
                const myModal = new bootstrap.Modal('#info')
                myModal.show();
                setTimeout(function () {
                    myModal.hide();
                }, 3000);
            }
        });
    </script>
@endsection
