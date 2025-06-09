<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckValueInHeader;
use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Support\Facades\Route;
Route::get("/test", [TestController::class, "testFunction"])->middleware("log_request", "jwt.auth", CheckIfAdmin::class);
Route::apiResource("/products", ProductController::class)->middleware(["check_value_in_header:123,maximo", "to_upper", "jwt.auth"]);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
//ESCRIBE ESTO CUANDO NO USES ALIAS EN LOS MIDDLEWARES
// Route::apiResource("/products", ProductController::class)->middleware([CheckValueInHeader::class, UpperCase::class]);
Route::middleware("jwt.auth")->group(function(){
    Route::get("/who", [AuthController::class, "who"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/refresh", [AuthController::class,"refresh"]);
});