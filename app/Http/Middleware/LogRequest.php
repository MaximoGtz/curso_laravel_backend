<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// Esto es lo que tengo que importar para guardar logs de la mejor manera
use Illuminate\Support\Facades\Log;
class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = [
            // para obtener la url
            "url" => $request->fullUrl(),
            // para obtener la ip
            "ip" => $request->ip(),
            // para obtener el método
            "method" => $request->method(),
            // para obtener los headers
            "headers" => $request->headers->all(),
            // para obtener el body (inputs)
            "body" => $request->getContent()
        ];
        $request->merge(["input" => "Viene del middleware"]);
        Log::info("Solicitud recibida: ", $data);
        return $next($request);
    }
    // este es el código que se retorna al terminar de salir del controlador
    public function terminate(Request $request, Response $response)
    {
        Log::info("Respuesta enviada: ", [
            "status" => $response->getStatusCode(),
            "content" => $response->getContent(),

        ]);
    }
}
