<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {

        return view('home.index', [
            "products" => Product::latest()->filter($request->query("search"))->paginate(8)->withQueryString(),
            "categories" => Category::all(),
            "productDeals" => Discount::all(),
        ]);
    }
}
