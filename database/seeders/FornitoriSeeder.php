<?php

namespace Database\Seeders;

use App\Models\Fornitore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FornitoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fornitore::insert([
            [
                'nome' => 'GN RESOUND',
                'indirizzo' => 'Via Pallavicini 17',
                'citta' => 'Roma',
                'provincia' => 'RM',
                'CAP' => '06054',
                'email' => 'dasfsdfasdfasd@dsafasdfas.it',
                'telefono' => '656484544',
                'pec' => 'dfadsfasdfasd@pec.it',
                'univoco' => 'sdfsdf443',
                'iban' => 'sdfsakljfòlasdfjkdslfdkj',
            ],
            [
                'nome' => 'PERSONUS',
                'indirizzo' => 'Via lfkaj slflka ',
                'citta' => 'Milano',
                'provincia' => 'Mi',
                'CAP' => '05586',
                'email' => 'dasfsdfasdfasd@dsafasdfas.it',
                'telefono' => '56498485',
                'pec' => 'dfadsfasdfasd@pec.it',
                'univoco' => 'sdfsdf443',
                'iban' => 'sdfsakljfòlasdfjkdslfdkj',
            ],
            [
                'nome' => 'PHONAK',
                'indirizzo' => 'Via Milano 17',
                'citta' => 'Genova',
                'provincia' => 'GE',
                'CAP' => '64894',
                'email' => 'dasfsdfasdfasd@dsafasdfas.it',
                'telefono' => '9884451',
                'pec' => 'dfadsfasdfasd@pec.it',
                'univoco' => 'sdfsdf443',
                'iban' => 'sdfsakljfòlasdfjkdslfdkj',
            ],
        ]);
    }
}
