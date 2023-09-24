<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home.index', [
            "products" => Product::latest()->paginate(8)->withQueryString(),
            "categories" => Category::all(),
        ]);
    }
}
