<?php

namespace App\Services;

use App\Models\Configuration;
use App\Models\Documento;
use App\Models\Fattura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FatturaService
{
    public function creaProforma($request)
    {
        return Fattura::create($request->all());
    }

    public function creadProformaPdf($fattura, $configuration)
    {
        if (!Storage::disk('public')->exists('/documenti/'.$fattura->prova->client_id.'/')) {
            Storage::disk('public')->makeDirectory('/documenti/'.$fattura->prova->client_id.'/');
        }
        if (!Storage::disk('public')->exists('/fatture/'.$fattura->anno_fattura.'/')) {
            Storage::disk('public')->makeDirectory('/fatture/'.$fattura->anno_fattura.'/');
        }
        $linkDocumento = "storage/documenti/".$fattura->prova->client_id."/Fattura".$fattura->id.".pdf";
        $linkFattura = "storage/fatture/".$fattura->anno_fattura."/Fattura".$fattura->id.".pdf";
        PDF::loadHTML(view('pdf.fattura', compact('fattura', 'configuration')))
            ->save($linkDocumento)->save($linkFattura);
    }
}
