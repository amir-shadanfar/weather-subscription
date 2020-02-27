<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Repositories\Interfaces\AuthInterface;
use Touristalia\Auth\Repositories\TokenRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthInterface::class, TokenRepository::class);
    }
}
