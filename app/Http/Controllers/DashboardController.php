<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        $dataMonthlyOrder = collect([]);
        $dataMonthlyRevenue = collect([]);
        $month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        for ($i=0; $i < count($month) ; $i++) { 
            $orderCount = Order::whereMonth("created_at", $i)->count();
            $totalPriceSum = Order::whereMonth("created_at", $i)->sum("total_price");
            $dataMonthlyOrder->push($orderCount);
            $dataMonthlyRevenue->push($totalPriceSum);
        }
        

        $chartMonthlyOrder = new DashboardChart;
        $chartMonthlyRevenue = new DashboardChart;

        $chartMonthlyOrder->labels($month);
        $chartMonthlyRevenue->labels($month);
        $chartMonthlyOrder->dataset('Monthly Order', 'bar', $dataMonthlyOrder);
        $chartMonthlyRevenue->dataset('Monthly Revenue', 'line', $dataMonthlyRevenue);

        
        return view("admin.dashboard.index", [
            "products" => Product::all(),
            "orders" => Order::all(),
            "users" => User::all(),
            "chartMonthlyOrder" => $chartMonthlyOrder,
            "chartMonthlyRevenue" => $chartMonthlyRevenue,
        ]);
    }
}
