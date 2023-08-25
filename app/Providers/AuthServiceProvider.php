<?php

namespace App\Providers;

use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view-clients', function(User $user, $idFiliale=null){
            if ($user->isAdmin()){
                return 1;
            }
            return FilialeUser::where([['user_id', $user->id],['filiale_id', $idFiliale]])->firstOrFail();
        });
    }
}
