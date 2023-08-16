<?php

namespace Database\Seeders;

use App\Models\Filiale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilialiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filiale::insert([
           [
               'nome' => 'Roma 1',
               'indirizzo' => 'Via Pallavicini 17',
               'citta' => 'Roma',
               'provincia' => 'RM',
               'telefono' => '345435344234',
           ],
            [
                'nome' => 'Roma 2',
                'indirizzo' => 'Via di Villa Chigi 12',
                'citta' => 'Roma',
                'provincia' => 'RM',
                'telefono' => '454354353',
            ],
            [
                'nome' => 'Fabriano',
                'indirizzo' => 'Via Lucci 32',
                'citta' => 'Fabriano',
                'provincia' => 'AN',
                'telefono' => '645345343',
            ],
            [
                'nome' => 'Civitanova',
                'indirizzo' => 'Piazza XX Settembre 34',
                'citta' => 'Civitanova Marche',
                'provincia' => 'MC',
                'telefono' => '34354646',
            ],
        ]);
    }
}
