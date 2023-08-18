<div>
    <div class="d-flex">
        <div class="col">
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
        <div class="col">
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
        <div class="col">
            <select class="form-control" aria-label="Default select example" wire:model="listino_id">
                <option selected>listino...</option>
                @foreach($listino as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" placeholder="quantità" aria-label="Last name" wire:model="quantita">
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary" wire:click="richiediProdotti"> Richiedi</button>
        </div>
    </div>
</div>
