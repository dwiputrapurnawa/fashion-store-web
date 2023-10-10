<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        Category::create($validatedData);

        return back()->with("message", "Successfully created new category");
    }

}
