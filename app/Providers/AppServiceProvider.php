<?php

namespace App\Providers;

use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Services\HiService;
use App\Business\Services\HiUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aqui se pone con que implementación vamos a trabajar que interfaz
        //Por ejemplo aqui vamos a poner que la interfaz MessageServideInterface trabaje con la clas HiService
        $this->app->bind(MessageServiceInterface::class, HiUserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
