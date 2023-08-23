<?php

namespace App\Http\Controllers;

use App\Services\AudiometriaService;
use Illuminate\Http\Request;

class AudiometriaController extends Controller
{
    public function audiometrie($idClient, AudiometriaService $audiometriaService, $idAudiometria=null)
    {
        $clientConAudiometrieByIdClient = $audiometriaService->clientConAudiometrieByIdClient($idClient);
        if ($idAudiometria){
            $audiometria = $clientConAudiometrieByIdClient->audiometrie->where('id', $idAudiometria)->first();
        }else{
            $audiometria = $clientConAudiometrieByIdClient->audiometrie->first();
        }
        return view('user.audiometrie', [
            'clientConAudiometrieByIdClient' => $clientConAudiometrieByIdClient,
            'audiometria' => $audiometria
        ]);
    }
}
