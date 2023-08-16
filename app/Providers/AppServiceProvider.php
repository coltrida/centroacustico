<?php

namespace App\Providers;

use App\Models\Configuration;
use App\Models\Filiale;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();

        view()->composer('*', function (View $view){
            $nomeAzienda = Configuration::all()->count() > 0 ? Configuration::first()->nomeAzienda : 'Nome Azienda';
            $filiali = Filiale::orderBy('nome')->get();
            $view->with('nomeAzienda', $nomeAzienda)->with('filiali', $filiali);
        });
    }
}
