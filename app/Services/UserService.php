<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function userConProveInCorso($idProveInCorso)
    {
        return User::with(['prove' => function($p) use($idProveInCorso){
            $p->where('stato_id', $idProveInCorso)->with('client');
        }])->find(Auth::id());
    }

    public function userConProveFatturateNelMese($idProveFatturate, $anno, $mese)
    {

        return User::with(['prove' => function($p) use($idProveFatturate, $anno, $mese){
            $p->where([
                ['stato_id', $idProveFatturate],
                ['anno_fine', $anno],
                ['mese_fine', $mese],
            ])->with('client');
        }])->find(Auth::id());
    }
}
