<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// laravel comment
// laravel comment
class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user->role != "admin") {
            return response()->json(["error" => "El tipo de usuario no tiene acceso a este endpoint"], Response::HTTP_FORBIDDEN);
        }
        return response()->json(["Desde CheckIfAdmin" => $user, "role" => $user->role]);
    }
}
