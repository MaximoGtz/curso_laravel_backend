<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpperCase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has(("name"))) {
            # code...
            // Esta linea transforma el dato que estamos recibiendo en "name" y lo cambia a mayúsculas
            $request->merge([
                "name" => strtoupper($request->input("name"))
            ]);
        }

        return $next($request);
    }
}
