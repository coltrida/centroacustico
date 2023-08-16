<?php

namespace Database\Seeders;

use App\Models\Ruolo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruolo::insert([
            [
                'nome' => 'Admin'
            ],
            [
                'nome' => 'Audio'
            ],
            [
                'nome' => 'Amminist'
            ],
            [
                'nome' => 'Manager'
            ],
        ]);
    }
}
