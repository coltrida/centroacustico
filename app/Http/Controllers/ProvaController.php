<?php

namespace App\Http\Controllers;

use App\Services\ProvaService;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    public function prova($idClient, ProvaService $provaService)
    {
        return view('user.prova', [
            'clientConProvePassate' => $provaService->clientConProvePassate($idClient)
        ]);
    }
}
