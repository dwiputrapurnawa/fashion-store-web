<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        
        return view("admin.orders.index", [
            "orders" => Order::all(),
        ]);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            "shipping_id" => "required",
            "shipping_cost" => "required",
            "total_price" => "required"
        ]);

        if($request->coupon_id) {
            $validatedData["coupon_id"] = $request->coupon_id;
        }

        $validatedData["total_price"] = floatval(preg_replace('/[^\d.]/', '', $validatedData["total_price"]));

        $validatedData["invoice_number"] = "INV" . mt_rand(100000000000, 999999999999);

        $validatedData["user_id"] = auth()->user()->id;

        $validatedData["payment_status"] = "pending";

        $validatedData["order_status"] = "waiting";

        $validatedData["address"] = auth()->user()->address;

        $order = Order::create($validatedData);

        $products = auth()->user()->product_cart;

        foreach ($products as $product) {
            $price_per_unit = $product->pivot->quantity * ($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price);
            $order->products()->attach($product, [
                "quantity" => $product->pivot->quantity, 
                "price_per_unit" => $price_per_unit, 
                "created_at" => now(), 
                "updated_at" => now()
            ]);
        }

        Cart::where("user_id", auth()->user()->id)->delete();

        return redirect("/purchase")->with("message", "Successfully created new order");
    }

    public function update(Request $request) {
        $validatedData = $request->validate([
            "order_status" => "required",
        ]);

        if($request->tracking_number) {
            $validatedData["tracking_number"] = $request->tracking_number;
        }

        Order::where("id", $request->order_id)->update($validatedData);

        return back()->with("message", "Successfully updated data");
    }
}
