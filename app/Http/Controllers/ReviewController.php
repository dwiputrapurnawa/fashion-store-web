<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            "product_id" => "required",
            "rating" => "required",
            "review" => "required"
        ]);

        Review::create([
            "user_id" => auth()->user()->id,
            "product_id" => $request->product_id,
            "rating" => $request->rating,
            "content" => $request->review
        ]);

        return back()->with("message", "successfully review product");
    }
}
