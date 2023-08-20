<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'nome' => 'Admin',
                'email' => 'admin@admin.it',
                'ruolo_id' => 1,
                'password' => Hash::make('123456'),
            ],
            [
                'nome' => 'Andrea Mazzarella',
                'email' => 'andrea_mazzarella@askoltaora.it',
                'ruolo_id' => 2,
                'password' => Hash::make('123456'),
            ],
            [
                'nome' => 'Laura Mei',
                'email' => 'laura_mei@askoltaora.it',
                'ruolo_id' => 3,
                'password' => Hash::make('123456'),
            ],
            [
                'nome' => 'Valentina Lacedonia',
                'email' => 'valentina_lacedonia@askoltaora.it',
                'ruolo_id' => 2,
                'password' => Hash::make('123456'),
            ],
            [
                'nome' => 'Lorella Ruzzi',
                'email' => 'lorella_ruzzi@askoltaora.it',
                'ruolo_id' => 2,
                'password' => Hash::make('123456'),
            ],
            [
                'nome' => 'Diamante Vallifuoro',
                'email' => 'diamante_vallifuoro@askoltaora.it',
                'ruolo_id' => 2,
                'password' => Hash::make('123456'),
            ],
            [
                'nome' => 'David Palombi',
                'email' => 'david_palombi@askoltaora.it',
                'ruolo_id' => 2,
                'password' => Hash::make('123456'),
            ],
            [
                'nome' => 'Davide Coltrioli',
                'email' => 'davide_coltrioli@askoltaora.it',
                'ruolo_id' => 4,
                'password' => Hash::make('123456'),
            ],
        ]);
    }
}
