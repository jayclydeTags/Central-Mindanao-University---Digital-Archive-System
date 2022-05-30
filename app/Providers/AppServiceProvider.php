<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;


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

        ResetPassword::createUrlUsing(function ($user, string $token) {
            return 'http://localhost:8000/authentication/reset-password/'.$token.'/'.$user['email'];
        });
    }
}
