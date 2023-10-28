<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request) {
        if($request->file("file")) {
            
            $request->validate([
                "file" => "mimes:jpeg,jpg,png,gif|required|max:10000"
            ]);

            $path = $request->file("file")->store("profile-pictures");
            User::where("id", auth()->user()->id)->update([
                "profile_picture" => $path
            ]);

            return back()->with("message", "Successfully change profile picture");

        }

        if($request->name || $request->phone_number) {
            $validatedData = $request->validate([
                "name" => "required",
                "phone_number" => "required"
            ]);

            User::where("id", auth()->user()->id)->update($validatedData);

            return back()->with("message", "Successfully edited profile information");
        }

        if($request->address) {
            $validatedData = $request->validate([
                "address" => "required",
                "country" => "required",
                "state" => "required",
                "zip" => "required",
            ]);

            User::where("id", auth()->user()->id)->update($validatedData);

            return back()->with("message", "Successfully edited address information");
        }

        if($request->password) {
            $validatedData = $request->validate([
                "password" => "required",
            ]);

            $validatedData["password"] = bcrypt($validatedData["password"]);

            User::where("id", auth()->user()->id)->update($validatedData);

            return back()->with("message", "Successfully changed password");
        }
    }
}
