<?php

namespace App\Providers;

use App\ExternalService\ApiService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiService::class, function($app){
            // Aqui ya no lo enviamos directamente a env ya que necesitamos que la aplicación guarde caché para mejor performance
            //Esto lo busca automaticamente en la carpeta config archivo services, arreglo api y valor url
            $url = config("services.api.url");
            return new ApiService($url);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
