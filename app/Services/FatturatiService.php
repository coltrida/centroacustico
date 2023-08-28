<?php

namespace App\Services;

use App\Models\Fatturati;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FatturatiService
{
    public function incrementaFatturato($idUser, $anno, $mese, $importo)
    {
        $fatturato = Fatturati::firstOrCreate([
            'user_id' => $idUser,
            'anno' => $anno,
            'mese' => $mese,
        ]);

        $fatturato->importo += $importo;
        $fatturato->save();
    }

    public function fatturatoAnno($anno)
    {
        return User::with(['fatturati' => function($f) use($anno){
            $f->where('anno', $anno);
        }])->find(Auth::id())->fatturati()->sum('importo');
    }
}
