<?php

namespace App\Services;

use App\Models\Fattura;

class FatturaService
{
    public function creaProforma($request)
    {
        Fattura::create($request->all());
    }
}
