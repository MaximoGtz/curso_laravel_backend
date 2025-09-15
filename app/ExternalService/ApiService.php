<?php

namespace App\ExternalService;
// Con esto podemos hacer solicitudes http
use Illuminate\Support\Facades\Http;
class ApiService
{
    protected string $url;
    public function __construct(string $url){
        $this->url = $url;
    }
    public function getData()
    {
        // Hay algunas veces que queremos solicitar servicios de terceros los cuales no tienen verificación SSL que nos retorna un error tipo 35 y laravel por defecto nos impide recibir una respuesta. Para esos casos se hace lo siguiente:
        // $response2 = Http::withoutVerifying()->get($this->url);
        $response = Http::get($this->url);
        if($response->successful()){
            return $response->json();
        }else{
            return ["error" => "No se pudo consultar correctamente"];
        }
    }
}