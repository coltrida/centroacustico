<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'nomeAzienda' => 'Askolta Ora',
            'indirizzoAzienda' => 'via Tupini 23',
            'cittaAzienda' => 'Roma',
            'provinciaAzienda' => 'RM',
            'capAzienda' => '06012',
            'pivaAzienda' => '345363243453',
            'emailAzienda' => 'info@askoltaora.it',
            'pecAzienda' => 'askoltaora@pec.it',
            'telefonoAzienda' => '34344546646',
            'eseguitaConfigurazione' => 1,
            'magazzinoCentralizzato' => 1,
        ]);
    }
}
