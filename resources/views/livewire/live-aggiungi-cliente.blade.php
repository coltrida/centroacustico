<div>
    <h3 class="mb-3">Inserimento nuovo paziente</h3>

    <form wire:submit.prevent="submit">

        {{--@if( Session::has('message'))
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#exampleModal').modal();
                    setTimeout(function () {
                        $('#exampleModal').modal('hide');
                    }, 3000);
                });
            </script>
        @endif

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    </div>
                    <div class="modal-body">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        </div>--}}

        <div class="row mb-4">
            <div class="col-2">
                <select id="inputState" class="form-select" wire:model="tipo_id">
                    <option selected>tipo...</option>
                    @foreach($tipi as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                    @endforeach
                </select>
                @error('tipo_id') <span style="font-size: 12px; color: red"
                                        class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <input type="text" wire:model="nome" class="form-control" placeholder="Nome" aria-label="First name">
                @error('nome') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <input type="text" wire:model="cognome" class="form-control" placeholder="Cognome"
                       aria-label="First name">
                @error('cognome') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <input type="text" wire:model="telefono1" class="form-control" placeholder="telefono1"
                       aria-label="First name">
                @error('telefono1') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <input type="text" wire:model="telefono2" class="form-control" placeholder="telefono2"
                       aria-label="First name">
                @error('telefono2') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <input type="text" wire:model="indirizzo" class="form-control" placeholder="indirizzo" aria-label="First name">
                @error('indirizzo') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <input type="text" wire:model="citta" class="form-control" placeholder="citta" aria-label="First name">
                @error('citta') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-1">
                <input type="text" wire:model="provincia" class="form-control" placeholder="PR" aria-label="First name">
                @error('provincia') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-2">
                <input type="text" wire:model="cap" class="form-control" placeholder="cap" aria-label="First name">
                @error('cap') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col">
                <input type="text" wire:model="email" class="form-control" placeholder="email" aria-label="First name">
                @error('email') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-2">
                <input type="date" wire:model="dataNascita" class="form-control" placeholder="email" aria-label="First name">
                @error('dataNascita') <span style="font-size: 12px; color: red" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-4">
                <select class="form-select" wire:model="canale_id">
                    <option selected>canale Mkt...</option>
                    @foreach($canali as $canale)
                        <option value="{{$canale->id}}">{{$canale->nome}}</option>
                    @endforeach
                </select>
                @error('canale_id') <span style="font-size: 12px; color: red"
                                        class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <button class="btn btn-primary" type="submit">{{$idClient ? 'Modifica' : 'Aggiungi'}}</button>
        <a class="btn btn-warning" href="{{route('clienti', $idFiliale)}}">Annulla</a>
    </form>
</div>
