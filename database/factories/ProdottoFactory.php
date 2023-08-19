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
            'matricola' => fake()->unique()->randomNumber,
            'stato_id' => Arr::random([1,3,4]),
            'filiale_id' => rand(3,4),
            'listino_id' => rand(1,30),
            'prova_id' => null,
        ];
    }
}
