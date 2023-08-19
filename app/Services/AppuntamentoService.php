<?php

namespace App\Services;

use App\Models\Client;

class AppuntamentoService
{
    public function userConAppuntamentiByIdClient($idClient)
    {
        return Client::with('appuntamenti')->find($idClient);
    }
}
