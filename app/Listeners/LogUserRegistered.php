<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogUserRegistered implements ShouldQueue
{

    use InteractsWithQueue;


    /**
     * Create the event listener.
     */

     public $tries = 3;

    public function __construct()
    {
        //

    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $this->release(5);   
        // Log::info("nuevo usuario registrado", ["id" => $event->user->id]);
        throw new Exception("Algo ha salido mal. {$this->attempts()}");
    }
    public function failed(UserRegistered $event, $exception){
        Log::critical("El registro en el log del usuario: {$event->user["id"]}, Excepción: {$exception}");
    }
    
}
