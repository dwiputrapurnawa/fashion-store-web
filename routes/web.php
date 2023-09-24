<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [HomeController::class, "index"]);

Route::get("/login", [LoginController::class, "index"]);
Route::post("/login", [LoginController::class, "login"]);

Route::post("/logout", [LoginController::class, "logout"]);

Route::get("/register", [RegisterController::class, "index"]);
Route::post("/register", [RegisterController::class, "register"]);

Route::get("/product/{product:slug}", [ProductPageController::class, "index"]);

Route::get("/categories/{category:slug}", [CategoryPageController::class, "index"]);

Route::get("/cart", [CartController::class, "index"]);
