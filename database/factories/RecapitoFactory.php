<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recapito>
 */
class RecapitoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => 'farmacia '.fake()->firstName(),
            'indirizzo' => fake()->streetAddress,
            'citta' => fake()->city,
            'filiale_id' => rand(1,4)
        ];
    }
}
