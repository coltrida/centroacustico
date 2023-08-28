<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Services\FatturatiService;
use App\Services\StatoApaService;
use App\Services\UserService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function index(UserService $userService,
                          StatoApaService $statoApaService,
                          FatturatiService $fatturatiService)
    {
        if (Configuration::all()->count() > 0){
            if (Auth::user()->isAdmin()){
                return view('admin.home');
            }
            $anno = Carbon::now()->year;
            $mese = Carbon::now()->month;
            $idProveInCorso = $statoApaService->idStatoFromNome('PROVA IN CORSO');
            $idProveFatturate = $statoApaService->idStatoFromNome('FATTURATO');
            return view('user.home', [
                'userConProveInCorso' => $userService->userConProveInCorso($idProveInCorso),
                'userConProveFatturateNelMese' => $userService->userConProveFatturateNelMese($idProveFatturate, $anno, $mese),
                'fatturatoAnno' => $fatturatiService->fatturatoAnno($anno),
            ]);
        }
        return view('configura.confAzienda');
    }

    /*public function prova()
    {
        $pdf = PDF::loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }*/

}
