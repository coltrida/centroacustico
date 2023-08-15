<div class="mt-3">
    <div class="row mb-4">
        <div class="col">
            <input class="form-control" wire:model="nomeRuolo" type="text">
        </div>
        <div class="col">
            <button class="btn btn-primary" wire:click="aggiungiRuolo">Aggiungi Ruolo</button>
        </div>
    </div>

        @foreach($ruoli as $ruolo)
            <h4><span class="badge text-bg-success mt-2">{{ $ruolo->nome }}</span></h4>
        @endforeach

</div>
