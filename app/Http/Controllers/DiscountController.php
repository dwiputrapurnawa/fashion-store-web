<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function store(Request $request) {

        $request->validate([
            "productIds" => "required",
            "discount" => "required" 
        ]);

        $productIds = array_map("intval", explode(",", $request->productIds[0]));

        foreach($productIds as $productId) {

            $discountProduct = Discount::where("product_id", $productId);

            if($discountProduct->exists()) {

                if($request->discount == 0) {
                    $discountProduct->delete();
                } else {
                    $discountProduct->update(["percentage" => $request->discount]);
                }

                
            } else {
                if($request->discount != 0) {
                    Discount::create([
                        "product_id" => $productId,
                        "percentage" => $request->discount,
                    ]);
                }
            }


        }

        return back()->with("message", "Successfully added discount!");
        
    }
}
