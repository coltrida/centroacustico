<?php

namespace Database\Seeders;

use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssociaFilialeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idAndrea = User::where('nome', 'Andrea Mazzarella')->first()->id;
        $idLaura = User::where('nome', 'Laura Mei')->first()->id;
        $idLoretta = User::where('nome', 'Lorella Ruzzi')->first()->id;
        $idValentina = User::where('nome', 'Valentina Lacedonia')->first()->id;
        $idDiamante = User::where('nome', 'Diamante Vallifuoro')->first()->id;
        $idDavid = User::where('nome', 'David Palombi')->first()->id;

        $idFilialeFabriano = Filiale::where('nome', 'Fabriano')->first()->id;
        $idFilialeCivitanova = Filiale::where('nome', 'Civitanova')->first()->id;
        $idFilialeRoma1 = Filiale::where('nome', 'Roma 1')->first()->id;
        $idFilialeRoma2 = Filiale::where('nome', 'Roma 2')->first()->id;

        FilialeUser::insert([
            [
                'filiale_id' => $idFilialeFabriano,
                'user_id' => $idAndrea,
            ],
            [
                'filiale_id' => $idFilialeFabriano,
                'user_id' => $idLaura,
            ],
            [
                'filiale_id' => $idFilialeCivitanova,
                'user_id' => $idValentina,
            ],
            [
                'filiale_id' => $idFilialeCivitanova,
                'user_id' => $idLoretta,
            ],
            [
                'filiale_id' => $idFilialeRoma1,
                'user_id' => $idDiamante,
            ],
            [
                'filiale_id' => $idFilialeRoma2,
                'user_id' => $idDavid,
            ],
        ]);
    }
}
