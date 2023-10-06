<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index() {

        $orders = Order::where("user_id", auth()->user()->id)->latest()->get();

        return view("purchase.index", [
            "orders" => $orders,
            "categories" => Category::all(),
        ]);
    }
}
