<?php

namespace App\Http\Controllers;

use App\Services\ProvaService;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    public function prova($idClient)
    {
        return view('user.prova', [
            'idClient' => $idClient,
        ]);
    }
}
