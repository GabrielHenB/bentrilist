<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFour();

        //Isso testa se um usuario tera a abilidade admin caso passe pelo metodo callback
        \Illuminate\Support\Facades\Gate::define('admin', function (\App\Models\User $user) {
            //Duplicacao com o Middleware AdminCheck.php que pode
            //ser resolvida se usar o middleware nativo 'Can:admin' do Laravel
            return $user->username == "Admin";
        });
    }
}
