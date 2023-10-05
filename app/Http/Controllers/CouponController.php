<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function checkCoupon(Request $request) {
        
        $coupon = Coupon::where("code", $request->coupon)->get();


        if(!$coupon->isEmpty()) {
            return response()->json(["message" => "coupon is valid", "data" => $coupon->first()]);
        } else {
            return response()->json(["message" => "coupon is invalid"]);
        }
    }
}
