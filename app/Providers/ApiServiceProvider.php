<?php

namespace App\Providers;
use App\ExternalService\ApiService;
use App\ExternalService\Events\DataGet;
use App\ExternalService\Listeners\LogDataGet;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Event;

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
            //Esto lo busca automaticamente en la carpeta config archivo services, arreglo api y valor url
            $url = config("services.api.url");
            return new ApiService($url);
        });
    }

    /**
     * Bootstrap services.
     */
    // Lo que hace este método es ejecutar cosas posterior a la ejecucion de todos los registros del service provider
    //Pueden ser rutas, middlewares, el apartado de vistas en frontend, configuraciónes o eventos.

    //CABE ACLARAR que estos se crean y se ponen en funcionamiento despues de levantar todos los campos del register, por lo que podemos usar y acceder a estos servicios efectivamente
    public function boot(): void
    {
        // Aquí vamos a registrar una ruta extra
        Route::get("/api/post", function(ApiService $apiService){
            return response()->json($apiService->getData());
        });

        // Vamos a registrar tambien eventos TENEMOS QUE USAR EL FACADES EVENT

        //esto dice, cuando tengas el evento DataGet, vas a ejecutar el listener LogDataGet
        Event::listen(DataGet::class, LogDataGet::class);
    }
}
