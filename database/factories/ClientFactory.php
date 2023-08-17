<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nome = fake()->firstName();
        $cognome = fake()->lastName();
        return [
            'tipo_id' => rand(1,8),
            'nome' => $nome,
            'cognome' => $cognome,
            'telefono1' => fake()->phoneNumber,
            'telefono2' => fake()->phoneNumber,
            'indirizzo' => fake()->address,
            'citta' => fake()->city,
            'provincia' => 'ad',
            'cap' => '564654',
            'email' => fake()->email,
            'dataNascita' => fake()->date,
            'filiale_id' => rand(1,4),
            'fullName' => $nome.' '.$cognome,
            'fullNameReverse' => $cognome.' '.$nome,
        ];
    }
}
