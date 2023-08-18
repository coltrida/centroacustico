<?php

namespace Database\Seeders;

use App\Models\Listino;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<10; $i++){
            Listino::create([
                'nome' => 'Beltone'.$i,
                'fornitore_id' => 1,
                'categoria_id' => 1,
                'prezzolistino' => rand(1,4) * 1024,
                'giorniTempoDiReso' => rand(60,90),
            ]);
        }

        for ($i=0; $i<10; $i++){
            Listino::create([
                'nome' => 'accessBelt'.$i,
                'fornitore_id' => 1,
                'categoria_id' => 2,
                'prezzolistino' => rand(1,4) * 1024,
                'giorniTempoDiReso' => rand(60,90),
            ]);
        }

        for ($i=0; $i<5; $i++){
            Listino::create([
                'nome' => 'Istant'.$i,
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'prezzolistino' => rand(1,4) * 1024,
                'giorniTempoDiReso' => rand(60,90),
            ]);
        }

        for ($i=0; $i<5; $i++){
            Listino::create([
                'nome' => 'accessIstant'.$i,
                'fornitore_id' => 2,
                'categoria_id' => 2,
                'prezzolistino' => rand(1,4) * 1024,
                'giorniTempoDiReso' => rand(60,90),
            ]);
        }
    }
}
