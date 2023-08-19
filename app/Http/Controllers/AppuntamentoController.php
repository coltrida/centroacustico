<?php

namespace App\Http\Controllers;

use App\Services\AppuntamentoService;
use Illuminate\Http\Request;

class AppuntamentoController extends Controller
{
    public function appuntamenti($idClient, AppuntamentoService $appuntamentoService)
    {
        return view('user.appuntamento', [
            'userConAppuntamenti' => $appuntamentoService->userConAppuntamentiByIdClient($idClient),
            'nomeGiorno' => ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato']
        ]);
    }
}
