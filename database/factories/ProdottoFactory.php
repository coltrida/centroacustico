<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodotto>
 */
class ProdottoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'matricola' => Arr::random(['sdfad', 'dsafsadfsda', '3434543', 'ffg3434', 'dsf454365545', 'dsfd5555']),
            'stato_id' => rand(1, 4),
            'filiale_id' => rand(3,4),
            'listino_id' => rand(1,30),
            'client_id' => Arr::random([null, null, rand(1,200)]),
        ];
    }
}
