<?php

namespace App\Services;

use App\Models\Configuration;

class ConfigurationService
{
    public function setConfigurazione($request)
    {
        Configuration::create([
           'eseguitaConfigurazione' => 1,
           'nomeAzienda' => $request['nomeAzienda'],
           'indirizzoAzienda' => $request['indirizzoAzienda'],
           'cittaAzienda' => $request['cittaAzienda'],
           'provinciaAzienda' => $request['provinciaAzienda'],
           'pivaAzienda' => $request['pivaAzienda'],
           'emailAzienda' => $request['emailAzienda'],
           'pecAzienda' => $request['pecAzienda'],
           'telefonoAzienda' => $request['telefonoAzienda'],
           'magazzinoCentralizzato' => $request['magazzinoBool'],
        ]);

        if($request->hasfile('logoAzienda')) {
            $file = $request->file('logoAzienda');
            $filename = 'logoAzienda.jpg';
            $path = 'logo/';
            \Storage::disk('public')->putFileAs($path, $file, $filename);
        }
    }

    public function getConfigurazioni()
    {
        return Configuration::all()->first();
    }

    public function modificaConfigurazioni($request)
    {
        Configuration::all()->first()->update($request->all());
    }

}
