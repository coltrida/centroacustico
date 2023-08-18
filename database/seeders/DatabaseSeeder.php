<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RuoliSeeder::class);
        $this->call(FornitoriSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(TipologieSeeder::class);
        $this->call(CanaliSeeder::class);
        $this->call(ConfigurationSeeder::class);
        $this->call(FilialiSeeder::class);
        $this->call(RecapitiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ListinoSeeder::class);
        $this->call(AssociaFilialeUserSeeder::class);

        Storage::disk('public')->deleteDirectory('/logo/');
        Storage::disk('public')->makeDirectory('/logo');

        Storage::copy('logo.png', 'public/logo/logoAzienda.jpg');

    }
}
