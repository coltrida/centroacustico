<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function index()
    {
        if (Configuration::all()->count() > 0){
            return view('admin.home');
        }
        return view('configura.confAzienda');
    }

    /*public function prova()
    {
        $pdf = PDF::loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }*/

}
