<?php

namespace App\Services;

use App\Models\Statoapa;

class StatoApaService
{
    public function idStatoFromNome($nome)
    {
        return Statoapa::where('nome', $nome)->first()->id;
    }
}
