<?php

namespace Database\Seeders;

use App\Models\Audiometria;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AudiometriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clienti = Client::all();
        foreach ($clienti as $cliente){
            for ($i=0; $i<2; $i++){
                Audiometria::create([
                   'client_id' => $cliente->id,
                   '_125d' => Arr::random(['0', '10', '15']),
                   '_125s' => Arr::random(['0', '10', '15']),
                    '_250d' => Arr::random(['15', '20', '25']),
                    '_250s' => Arr::random(['15', '20', '25']),
                    '_500d' => Arr::random(['25', '30', '35']),
                    '_500s' => Arr::random(['25', '30', '35']),
                    '_1000d' => Arr::random(['35', '40', '45']),
                    '_1000s' => Arr::random(['35', '40', '45']),
                    '_1500d' => Arr::random(['35', '40', '45']),
                    '_1500s' => Arr::random(['35', '40', '45']),
                    '_2000d' => Arr::random(['45', '50', '55']),
                    '_2000s' => Arr::random(['45', '50', '55']),
                    '_3000d' => Arr::random(['55', '60', '65']),
                    '_3000s' => Arr::random(['55', '60', '65']),
                    '_4000d' => Arr::random(['65', '70', '75']),
                    '_4000s' => Arr::random(['65', '70', '75']),
                    '_6000d' => Arr::random(['75', '80', '85']),
                    '_6000s' => Arr::random(['75', '80', '85']),
                    '_8000d' => Arr::random(['85', '90', '90']),
                    '_8000s' => Arr::random(['85', '90', '90']),
                ]);
            }
        }
    }
}
