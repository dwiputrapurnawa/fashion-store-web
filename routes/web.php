<?php

use App\Http\Controllers\AccountSettingsController;
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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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

Route::get("/login", [LoginController::class, "index"])->name("login");
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

Route::get("/cart", [CartController::class, "index"])->middleware("auth");
Route::post("/cart", [CartController::class, "store"])->middleware("auth");
Route::delete("/cart", [CartController::class, "destroy"])->middleware("auth");
Route::patch("/cart", [CartController::class, "update"])->middleware("auth");

Route::get("/wishlist", [WishlistController::class, "index"])->middleware("auth");
Route::post("/wishlist", [WishlistController::class, "store"])->middleware("auth");
Route::delete("/wishlist", [WishlistController::class, "destroy"])->middleware("auth");

Route::post("/comment", [CommentController::class, "store"])->middleware("auth");
Route::delete("/comment", [CommentController::class, "destroy"])->middleware("auth");

Route::get("/coupon", [CouponController::class, "checkCoupon"])->middleware("auth");

Route::get("/purchase", [PurchaseController::class, "index"])->middleware("auth");

Route::get("/dashboard", [DashboardController::class, "index"])->middleware("is_admin");
Route::get("/dashboard/products", [ProductController::class, "index"])->middleware("is_admin");
Route::get("/dashboard/products/create", [ProductController::class, "create"])->middleware("is_admin");
Route::get("/dashboard/products/{product:slug}", [ProductController::class, "show"])->middleware("is_admin");
Route::get("/dashboard/products/{product:slug}/edit", [ProductController::class, "edit"])->middleware("is_admin");


Route::post("/images", [ImagesController::class, "store"])->middleware("is_admin");
Route::delete("/images", [ImagesController::class, "destroy"])->middleware("is_admin");

Route::get("/dashboard/orders", [OrderController::class, "index"])->middleware("is_admin");
Route::patch("/order", [OrderController::class, "update"])->middleware("is_admin");
Route::post("/order", [OrderController::class, "store"])->middleware("is_admin");

Route::post("/discount", [DiscountController::class, "store"]);

Route::get("/dashboard/customers", [CustomerController::class, "index"])->middleware("is_admin");
Route::post("/dashboard/customers", [CustomerController::class, "store"])->middleware("is_admin");
Route::delete("/dashboard/customers", [CustomerController::class, "destroy"])->middleware("is_admin");
Route::patch("/dashboard/customers", [CustomerController::class, "update"])->middleware("is_admin");

Route::post("/review", [ReviewController::class, "store"])->middleware("auth");

Route::get("/account-settings", [AccountSettingsController::class, "index"])->middleware("auth");
Route::get("/account-settings/change-password", [AccountSettingsController::class, "change_password_index"])->middleware("auth");

Route::patch("/user", [UserController::class, "update"])->middleware("auth");