<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Console\View\Components\Info;
use Illuminate\Support\Facades\Route;
//LLLARAVEL
Route::get("/test", [TestController::class, "testFunction"])->middleware("log_request", "jwt.auth", CheckIfAdmin::class);
// Route::apiResource("/products", ProductController::class)->middleware(["check_value_in_header:123,maximo", "to_upper", "jwt.auth"]);
Route::apiResource("/products", ProductController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
//ESCRIBE ESTO CUANDO NO USES ALIAS EN LOS MIDDLEWARES
// Route::apiResource("/products", ProductController::class)->middleware([CheckValueInHeader::class, UpperCase::class]);
Route::middleware("jwt.auth")->group(function(){
    Route::get("/who", [AuthController::class, "who"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/refresh", [AuthController::class,"refresh"]);
});
Route::get("/info/message", [InfoController::class, "message"]);
// Route::get("/info/message2", [InfoController::class, "message2"]);
Route::get("/product/tax/{id}", [InfoController::class, "taxes"]);
Route::get("/info/encrypt/{data}", [InfoController::class, "encrypt"]);
Route::get("/info/decrypt/{data}", [InfoController::class, "decrypt"]);
Route::get("/product/prices/{id}", [InfoController::class, "getProductPrice"]);
Route::get("/encrypt/email/{id}", [InfoController::class, "encryptEmail"]);
Route::get("/encrypt/email2/{id}", [InfoController::class, "encryptEmail2"]);
Route::get("/info/singleton", [InfoController::class, "singleton"]);
Route::get ("/getProductPrice/{product_id}", [ProductController::class, "getProductPrice"]);
Route::get ("/getProductPrice2/{product_id}", [InfoController::class, "getPartnerPrice"]);