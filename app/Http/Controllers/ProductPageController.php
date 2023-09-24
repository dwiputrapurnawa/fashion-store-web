<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index(Product $product) {
        return view("product.index", [
            "product" => $product,
            "categories" => Category::all(),
        ]);
    }
}
