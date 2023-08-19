<?php

namespace App\Http\Controllers;

use App\Services\TelefonataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TelefonataController extends Controller
{
    public function telefonata($idClient, TelefonataService $telefonataService)
    {
        return view('user.telefonata', [
            'userConTelefonate' => $telefonataService->userConTelefonate($idClient)
        ]);
    }

    public function telefonataEffettuata(Request $request, TelefonataService $telefonataService)
    {
        $telefonataService->salvaTelefonata($request);
        session()->flash('message', "Telefonata inserita");
        return Redirect::back();
    }
}
