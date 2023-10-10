<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {

        $products = auth()->user()->product_cart;

        return view("cart.index", [
            "categories" => Category::all(),
            "products" => $products,
            "shippings" => Shipping::all(),
        ]);
    }

    public function store(Request $request) {

        $request->merge(["user_id" => auth()->user()->id]);

        $validatedData = $request->validate([
            "product_id" => "required",
            "quantity" => "required",
            "user_id" => "required"
        ]);

        Cart::create($validatedData);

        return back()->with("message", "Successfully added item to the cart!");
    }

    public function destroy(Request $request) {
        $validatedData = $request->validate([
            "selected_cart_id" => "required"
        ]);

        Cart::where("id", $validatedData["selected_cart_id"])->delete();

        return back()->with("message", "Successfully deleted item in the cart!");
    }

    public function update(Request $request) {
        
        Cart::where("id", $request->cart_id)->update(["quantity" => $request->quantity]);

        return response()->json(["message" => "Successfully updated cart!"]);
    }
}
