<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppuntamentoController extends Controller
{
    public function appuntamenti($idClient)
    {
        return view('user.appuntamento', [
            'idClient' => $idClient
        ]);
    }
}
