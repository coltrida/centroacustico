<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Services\ConfigurationService;
use App\Services\FilialeService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        if (Configuration::all()->count() > 0){
            return view('admin.home');
        }
        return view('configura.confMagazzini');
    }

    public function setMagazzini(Request $request, ConfigurationService $configurationService)
    {
        $configurationService->setMagazzini($request);
        return view('configura.confRuoli');
    }

    public function filiali(FilialeService $filialeService)
    {
        return view('admin.filiali', [
           'filiali' => $filialeService->listaFiliali()
        ]);
    }
}
