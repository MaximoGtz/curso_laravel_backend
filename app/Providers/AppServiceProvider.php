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
        $this->app->bind(EncryptService::class, function(){
            return new EncryptService(env("KEY_ENCRYPT"));
        });
        $this->app->bind(SalesServiceInterface::class, OwnerCostsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
