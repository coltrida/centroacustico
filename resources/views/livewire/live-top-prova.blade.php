<div>
    <div class="d-flex">
        <div class="col-3">
            <select class="form-control" aria-label="Default select example"
                    wire:model="fornitore_id"
                    wire:change="selezionaFornitore"
            >
                <option selected>fornitore...</option>
                @foreach($fornitori as $fornitore)
                    <option value="{{$fornitore->id}}">{{$fornitore->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <select class="form-control" aria-label="Default select example"
                    wire:model="categoria_id"
                    wire:change="selezionaCategoria"
            >
                <option selected>categoria...</option>
                @foreach($categorie as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <select class="form-control" aria-label="Default select example"
                    wire:model="listino_id"
                    wire:change="selezionaListino"
            >
                <option selected>listino...</option>
                @foreach($listino as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <select class="form-control" aria-label="Default select example" wire:model="product_id">
                <option selected>matricola...</option>
                 @foreach($matricole as $item)
                     <option value="{{$item->id}}">{{$item->matricola}}</option>
                 @endforeach
            </select>
        </div>
        <div >
            <button type="submit" class="btn btn-primary" wire:click="inserisciInProva"> Inserisci</button>
        </div>
    </div>
</div>
