<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckValueInHeader;
use App\Http\Middleware\UpperCase;
use Illuminate\Support\Facades\Route;

Route::get("/test", [TestController::class, "testFunction"])->middleware("log_request");
Route::apiResource("/products", ProductController::class)->middleware(["check_value_in_header:123,maximo", "to_upper"]);
//ESCRIBE ESTO CUANDO NO USES ALIAS EN LOS MIDDLEWARES
// Route::apiResource("/products", ProductController::class)->middleware([CheckValueInHeader::class, UpperCase::class]);