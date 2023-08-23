<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudiometriaController extends Controller
{
    public function audiometrie($idClient)
    {
        return view('user.audiometrie');
    }
}
