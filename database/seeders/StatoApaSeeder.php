<?php

namespace Database\Seeders;

use App\Models\Statoapa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatoApaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statoapa::insert([
            [
                'nome' => 'MAGAZZINO'
            ],
            [
                'nome' => 'IN PROVA'
            ],
            [
                'nome' => 'SPEDITO'
            ],
            [
                'nome' => 'RICHIESTO'
            ],
        ]);
    }
}
