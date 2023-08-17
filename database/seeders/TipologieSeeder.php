<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipologieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::insert([
            [
                'nome' => 'LEAD',
                'giorniToRecall' => null
            ],
            [
                'nome' => 'CL',
                'giorniToRecall' => null
            ],
            [
                'nome' => 'PC',
                'giorniToRecall' => 90
            ],
            [
                'nome' => 'CLC',
                'giorniToRecall' => 300
            ],
            [
                'nome' => 'PREM',
                'giorniToRecall' => 400
            ],
            [
                'nome' => 'DEC',
                'giorniToRecall' => null
            ],
            [
                'nome' => 'TAPPO',
                'giorniToRecall' => null
            ],
            [
                'nome' => 'NORMO',
                'giorniToRecall' => null
            ],
        ]);
    }
}
