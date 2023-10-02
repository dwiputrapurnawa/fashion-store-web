<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {

        $request->merge(["user_id" => auth()->user()->id]);

        $validatedData = $request->validate([
            "user_id" => "required",
            "product_id" => "required",
            "content" => "required"
        ]);

        if($request->parent_id) {
            $validatedData["parent_id"] = $request->parent_id;
        } else {
            $validatedData["parent_id"] = 0;
        }

        Comment::create($validatedData);

        return back()->with("message", "successfully add new comment");
    }
}
