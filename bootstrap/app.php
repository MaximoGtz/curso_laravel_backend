<?php

use App\Http\Middleware\CheckValueInHeader;
use App\Http\Middleware\LogRequest;
use App\Http\Middleware\UpperCase;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //Aqui van los middlewares globales
        // $middleware->append(CheckValueInHeader::class);
        //Para agregar alias los middlewares y poder consultarlos en el api.php sin tener que importarlos es así:
        $middleware->alias([
            "check_value_in_header" => CheckValueInHeader::class,
            "to_upper" => UpperCase::class,
            "log_request" => LogRequest::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})
    // we can add task that execute automatically whenever you want
    ->withSchedule(function (Schedule $schedule){
        $schedule->command("maintenance:clear-old-uploads")->everyMinute();
    })
    ->create();
