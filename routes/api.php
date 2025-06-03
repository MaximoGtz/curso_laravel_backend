<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get("/test", [TestController::class, "testFunction"]);
Route::apiResource("/products", ProductController::class);