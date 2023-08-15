<?php

namespace App\Services;

use App\Models\Configuration;

class ConfigurationService
{
    public function setMagazzini($request)
    {
        Configuration::create([
           'eseguita' => 1,
           'magazzinoCentralizzato' => $request['magazzinoBool']
        ]);
    }
}
