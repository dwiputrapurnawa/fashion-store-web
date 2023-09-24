<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {

        $products = auth()->user()->product;

        return view("cart.index", [
            "categories" => Category::all(),
            "products" => $products,
        ]);
    }
}
