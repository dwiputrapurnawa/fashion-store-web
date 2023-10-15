<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        
        return view("admin.orders.index", [
            "orders" => Order::all(),
        ]);
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
