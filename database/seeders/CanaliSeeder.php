<?php

namespace Database\Seeders;

use App\Models\Canale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CanaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Canale::insert([
            [
                'nome' => 'SCREENING'
            ],
            [
                'nome' => 'TLK FILIALE'
            ],
            [
                'nome' => 'CALL CENTER'
            ],
            [
                'nome' => 'MEDICO'
            ],
            [
                'nome' => 'PASSAPAROLA'
            ],
            [
                'nome' => 'SOCIAL'
            ],
            [
                'nome' => 'VETRINA'
            ],
        ]);
    }
}
