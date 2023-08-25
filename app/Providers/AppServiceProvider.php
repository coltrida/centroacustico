<?php

namespace App\Providers;

use App\Models\Configuration;
use App\Models\Filiale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            $filiali = [];
            if (Auth::check()){
                if (Auth::user()->isAdmin()){
                    $filiali = Filiale::with(['users' => function($u){
                        $u->with('ruolo');
                    }])->orderBy('nome')->get();
                } else {
                    $filiali = User::with(['filiali' => function($f){
                        $f->with(['users' =>function($u){
                            $u->with('ruolo');
                        }]);
                    }])->find(Auth::id())->filiali;
                }
            }

            $view->with('nomeAzienda', $nomeAzienda)->with('filiali', $filiali);
        });
    }
}
