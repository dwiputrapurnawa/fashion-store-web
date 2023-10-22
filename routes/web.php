<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WishlistController;
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
Route::delete("/product", [ProductController::class, "destroy"]);
Route::put("/product", [ProductController::class, "update"]);
Route::post("/product", [ProductController::class, "store"]);

Route::get("/categories/{category:slug}", [CategoryPageController::class, "index"]);
Route::post("/categories", [CategoryController::class, "store"]);

Route::get("/cart", [CartController::class, "index"]);
Route::post("/cart", [CartController::class, "store"]);
Route::delete("/cart", [CartController::class, "destroy"]);
Route::patch("/cart", [CartController::class, "update"]);

Route::get("/wishlist", [WishlistController::class, "index"]);
Route::post("/wishlist", [WishlistController::class, "store"]);
Route::delete("/wishlist", [WishlistController::class, "destroy"]);

Route::post("/comment", [CommentController::class, "store"]);
Route::delete("/comment", [CommentController::class, "destroy"]);

Route::get("/coupon", [CouponController::class, "checkCoupon"]);

Route::get("/purchase", [PurchaseController::class, "index"]);

Route::get("/dashboard", [DashboardController::class, "index"]);
Route::get("/dashboard/products", [ProductController::class, "index"]);
Route::get("/dashboard/products/create", [ProductController::class, "create"]);
Route::get("/dashboard/products/{product:slug}", [ProductController::class, "show"]);
Route::get("/dashboard/products/{product:slug}/edit", [ProductController::class, "edit"]);


Route::post("/images", [ImagesController::class, "store"]);
Route::delete("/images", [ImagesController::class, "destroy"]);

Route::get("/dashboard/orders", [OrderController::class, "index"]);
Route::patch("/order", [OrderController::class, "update"]);
Route::post("/order", [OrderController::class, "store"]);

Route::post("/discount", [DiscountController::class, "store"]);

Route::get("/dashboard/customers", [CustomerController::class, "index"]);
Route::post("/dashboard/customers", [CustomerController::class, "store"]);
Route::delete("/dashboard/customers", [CustomerController::class, "destroy"]);
Route::patch("/dashboard/customers", [CustomerController::class, "update"]);