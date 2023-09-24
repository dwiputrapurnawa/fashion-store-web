<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    public function index(Category $category) {
        return view("category.index", [
            "category" => $category,
            "products" => $category->product()->latest()->paginate(8)->withQueryString(),
            "categories" => Category::all(),
        ]);
    }
}
