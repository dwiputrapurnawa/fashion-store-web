<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function store(Request $request) {

        $validatedData = $request->validate([
            "product_id" => "required",
            'files.*' => 'required|image|max:2048',
        ]);

        if($request->file("files")) {

            foreach($request->file("files") as $file) {
                $validatedData["path"] = $file->store("product-images");
                Images::create($validatedData);
            }

            
        }

        return back()->with("message", "successfully uploaded images");
    }

    public function destroy(Request $request) {

        Images::where("id", $request->image_id)->delete();
        
        Storage::delete($request->image_path);

        return back()->with("message", "successfully deleted image");

    }
}
