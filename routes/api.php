<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckValueInHeader;
use Illuminate\Support\Facades\Route;

Route::get("/test", [TestController::class, "testFunction"]);
Route::apiResource("/products", ProductController::class)->middleware(CheckValueInHeader::class);