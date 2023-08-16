<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function (View $view){
            $nomeAzienda = Configuration::all()->count() > 0 ? Configuration::first()->nomeAzienda : 'Nome Azienda';
            $view->with('nomeAzienda', $nomeAzienda);
        });
    }
}
