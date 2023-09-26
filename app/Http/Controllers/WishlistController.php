<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index() {

        $products = auth()->user()->wishlist;

        return view("wishlist.index", [
            "categories" => Category::all(),
            "products" => $products
        ]);
    }

    public function store(Request $request) {

        $request->merge(["user_id" => auth()->user()->id]);

        $validatedData = $request->validate([
            "product_id" => "required",
            "user_id" => "required"
        ]);

        Wishlist::create($validatedData);

        return back()->with("message", "Successfully added item to your wishlist!");

    }

    public function destroy(Request $request) {

        Wishlist::where("user_id", auth()->user()->id)->where("product_id", $request->product_id)->delete();

        return back()->with("message", "Successfully delete item from wishlist!");

    }
}
