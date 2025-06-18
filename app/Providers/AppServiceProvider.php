<?php

namespace App\Providers;

use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Interfaces\ProductServiceInterface;
use App\Business\Interfaces\SalesServiceInterface;
use App\Business\Services\EncryptService;
use App\Business\Services\HiService;
use App\Business\Services\HiUserService;
use App\Business\Services\OwnerCostsService;
use App\Business\Services\PartnerCostsService;
use App\Business\Services\ProductService;
use App\Business\Services\SingletonService;
use App\Business\Services\UserService;
use App\Http\Controllers\InfoController;
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
        $this->app->bind(MessageServiceInterface::class, HiService::class);
        $this->app->bind(EncryptService::class, function(){
            return new EncryptService(env("KEY_ENCRYPT"));
        });
        $this->app->bind(SalesServiceInterface::class, OwnerCostsService::class);
        //En caso de que no encuentre (lo cual es muy raro) el servicio UserService, puedes definirlo aquí de la siguiente manera:
        $this->app->bind(UserService::class, function($app){
            return new UserService($app->make(EncryptService::class));
        });
        //Cuando quieres especificar una implementación en específico para algún controlador puedes hacer lo siguiente (ojo, solo sirve cuando la implementación se encuentra en el constructor de la clase)
        // cuando la clase infoController
        $this->app->when(InfoController::class)
            //necesite la implementación
            ->needs(MessageServiceInterface::class)
            //dale la implementación de la clase HiService en vez de HiService como dice en el global
            ->give(HiUserService::class);

        //Cuando un objeto es muy pesado o de alguna forma necesitamos que sea el mismo por solicitud, aunque se llame varias veces podemos hacer que sea el mismo haciendo lo siguiente:
        $this->app->singleton(SingletonService::class, function($app){
            // De esta forma arroja los mismos resultados aunque se delcae varias veces en la funcion del controlador POR PETICIÓN
            return new SingletonService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
