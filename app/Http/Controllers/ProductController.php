<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Images;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index() {
        return view("admin.products.index", [
            "products" => Product::all(),
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            "name" => "required",
            "price" => "required",
            "stock" => "required",
            "weight" => "required",
            "category_id" => "required",
            'files.*' => 'required|image|max:2048',
            "description" => "required|max:500"
        ]);
        
        $product = Product::create($validatedData);

        if($request->file("files")) {
            foreach($request->file("files") as $file) {
                $path = $file->store("product-images");
                Images::create([
                    "product_id" => $product->id,
                    "path" => $path
                ]);
            }
        }

        return back()->with("message", "Successfully added new product");

    }

    public function create() {
        return view("admin.products.create", [
            "categories" => Category::all(),
        ]);
    }

    public function show(Product $product) {
        return view("admin.products.show", [
            "product" => $product
        ]);
    }

    public function edit(Product $product) {
        return view("admin.products.edit", [
            "product" => $product,
            "categories" => Category::all(),
        ]);
    }

    public function update(Request $request) {
        
        $validatedData = $request->validate([
            "name" => "required",
            "price" => "required",
            "stock" => "required",
            "weight" => "required",
            "description" => "required|max:500",
            "category_id" => "required",
        ]);


        Product::where("id", $request->product_id)->update($validatedData);

        return redirect("/dashboard/products")->with("message", "successfully updated data");

    }

    public function destroy(Request $request) {
        $validatedData = $request->validate([
            "product_id" => "required"
        ]);

        Product::where("id", $validatedData["product_id"])->delete();
        Images::where("product_id", $validatedData["product_id"])->delete();
        Discount::where("product_id", $validatedData["product_id"])->delete();

        return redirect("/dashboard/products")->with("message", "Successfully deleted product");
    }

    // public function destroy(Request $request) {
    //     $productIds = $request;

    //     Product::whereIn("id", $productIds)->delete();

    //     return response()->json(["message", "successfully deleted item"]);
    // }
}
