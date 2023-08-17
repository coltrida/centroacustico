<?php

namespace App\Http\Controllers;

use App\Models\Configuration;

class FrontController extends Controller
{
    public function index()
    {
        if (Configuration::all()->count() > 0){
            return view('admin.home');
        }
        return view('configura.confAzienda');
    }

}
