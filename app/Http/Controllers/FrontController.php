<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function index()
    {
        if (Configuration::all()->count() > 0){
            if (Auth::user()){
                return view('admin.home');
            }
            return Redirect::route('login');
        }
        return view('configura.confAzienda');
    }

}
